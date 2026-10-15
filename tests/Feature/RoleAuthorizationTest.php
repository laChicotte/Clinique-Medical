<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class RoleAuthorizationTest extends TestCase
{
    #[DataProvider('forbiddenRequests')]
    public function test_direct_requests_with_an_unauthorized_role_are_forbidden(
        string $role,
        string $method,
        string $uri
    ): void {
        $this->actingAs($this->userWithRole($role));

        $this->call($method, $uri)->assertForbidden();
    }

    public static function forbiddenRequests(): array
    {
        return [
            'user list' => ['doctor', 'GET', '/users/manage-user'],
            'create account' => ['doctor', 'POST', '/users/saveUser/1'],
            'delete account' => ['pharmacy', 'DELETE', '/user/delete/1'],
            'change another user password' => ['accounting', 'POST', '/user/change/2'],
            'password management' => ['doctor', 'GET', '/password/manage-password-reset'],
            'employee department' => ['doctor', 'PUT', '/employees/valide-departement/1'],
            'patient update' => ['doctor', 'PUT', '/patient/update-patient/1'],
            'patient deletion' => ['doctor', 'DELETE', '/patient/delete-patient/1'],
            'patient records' => ['accounting', 'GET', '/patients/all-patient'],
            'product write' => ['doctor', 'POST', '/product/save'],
            'category deletion' => ['doctor', 'DELETE', '/category/delete/1'],
            'prescription write' => ['pharmacy', 'POST', '/save-prescription'],
            'laboratory result' => ['accounting', 'PUT', '/laboratory-result/1'],
            'surgery write' => ['laboratory', 'POST', '/surgeries/store'],
            'vendor write' => ['pharmacy', 'POST', '/vendor/saveVendor'],
            'inventory' => ['doctor', 'GET', '/inventory/inventory-product'],
            'payroll write' => ['doctor', 'POST', '/payroll/store'],
            'payroll print' => ['pharmacy', 'GET', '/payroll/print/1'],
            'accounting' => ['doctor', 'GET', '/accounting/manage-accountPay'],
            'medical report' => ['pharmacy', 'GET', '/record/detail-patient/1'],
            'employee medical report' => ['accounting', 'GET', '/record/detail-employee/1'],
            'unknown role' => ['unknown', 'GET', '/users/manage-user'],
            'missing role' => ['', 'GET', '/users/manage-user'],
        ];
    }

    #[DataProvider('allowedRequests')]
    public function test_authorized_roles_pass_the_real_route_middleware(
        string $role,
        string $uri
    ): void {
        $this->actingAs($this->userWithRole($role));

        $route = app('router')->getRoutes()->match(Request::create($uri));

        // Exercise the real route's authentication and role checks without
        // running its controller or touching the application's database.
        Route::get('/_test/role-access', fn () => response('ok'))
            ->middleware($route->gatherMiddleware());

        $this->get('/_test/role-access')->assertOk()->assertSee('ok');
    }

    public static function allowedRequests(): array
    {
        return [
            'admin accounts' => ['admin', '/users/manage-user'],
            'admin patients' => ['admin', '/patients/manage-patient'],
            'admin employees' => ['admin', '/employees/manage-employee'],
            'admin vendors' => ['admin', '/vendor/manage-vendor'],
            'admin inventory' => ['admin', '/inventory/inventory-product'],
            'doctor patients' => ['doctor', '/patients/all-patient'],
            'doctor prescriptions' => ['doctor', '/prescriptions/manage-prescription'],
            'doctor laboratory' => ['doctor', '/laboratory/lab-patient-result'],
            'doctor surgery' => ['doctor', '/bloc/manage-patient'],
            'doctor reports' => ['doctor', '/record/record-medical'],
            'pharmacy' => ['pharmacy', '/products/manage-product'],
            'legacy pharmacy' => ['pharmacie', '/products/manage-product'],
            'pharmacy reports' => ['pharmacy', '/record/record-product'],
            'accounting' => ['accounting', '/payroll/manage-payroll'],
            'legacy accounting' => ['comptable', '/payroll/manage-payroll'],
            'accounting accounts' => ['accounting', '/accounting/manage-accountPay'],
            'laboratory' => ['laboratory', '/laboratory/lab-patient-result'],
            'surgery' => ['surgery', '/bloc/manage-patient'],
        ];
    }

    public function test_guests_are_redirected_to_login_before_role_checks(): void
    {
        $this->get('/users/manage-user')->assertRedirect(route('loginAdmin'));
    }

    public function test_every_business_route_requires_an_explicit_role(): void
    {
        $sharedActions = ['adminDashboardPage', 'adminMyProfilePage', 'adminLogOutPage', 'changePasswordUser'];

        foreach (app('router')->getRoutes() as $route) {
            $middleware = $route->gatherMiddleware();

            if (!in_array('auth', $middleware, true)
                || in_array($route->getActionMethod(), $sharedActions, true)) {
                continue;
            }

            $roleChecks = array_filter($middleware, fn ($name) =>
                is_string($name) && str_starts_with($name, 'role:')
            );

            $this->assertNotEmpty($roleChecks, 'Missing role check: '.$route->uri());
        }
    }

    private function userWithRole(string $role): User
    {
        return (new User())->forceFill(['id' => 1, 'name' => 'Test', 'role' => $role]);
    }
}
