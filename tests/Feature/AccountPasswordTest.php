<?php

namespace Tests\Feature;

use App\Models\Employee;
use App\Models\User;
use Database\Seeders\UserSeeder;
use Illuminate\Console\Command;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\ValidationException;
use Mockery;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class AccountPasswordTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        if (!in_array('sqlite', \PDO::getAvailableDrivers(), true)) {
            $this->markTestSkipped('The pdo_sqlite extension is required.');
        }

        // Isolate these tests from the database configured in .env.
        config([
            'database.default' => 'password_tests',
            'database.connections.password_tests' => [
                'driver' => 'sqlite', 'database' => ':memory:', 'prefix' => '',
            ],
        ]);

        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('doc_fname');
            $table->string('doc_lname');
            $table->string('doc_email')->unique();
            $table->string('doc_dept')->nullable();
            $table->unsignedTinyInteger('has_account')->default(0);
            $table->timestamps();
        });

        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('employee_id')->unique();
            $table->string('role');
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    protected function tearDown(): void
    {
        DB::purge('password_tests');
        parent::tearDown();
    }

    public function test_accounts_receive_distinct_random_passwords_stored_as_hashes(): void
    {
        $this->actingAs((new User())->forceFill(['id' => 99, 'role' => 'admin']));
        $passwords = [];

        foreach (['first@example.test', 'second@example.test'] as $email) {
            $employee = $this->employee($email);

            $response = $this->post(route('user.store', $employee->id));
            $response->assertRedirect(route('addUser'))->assertSessionHas('new_account.email', $email);

            $password = session('new_account.password');
            $user = User::where('employee_id', $employee->id)->firstOrFail();

            $this->assertSame(20, strlen($password));
            $this->assertTrue(Hash::check($password, $user->password));
            $this->assertNotSame($password, $user->password);
            $this->assertSame('doctor', $user->role);
            $this->assertSame(1, (int) $employee->fresh()->has_account);
            $passwords[] = $password;
        }

        $this->assertNotSame($passwords[0], $passwords[1]);
    }

    public function test_get_requests_cannot_create_an_account(): void
    {
        $this->actingAs((new User())->forceFill(['id' => 99, 'role' => 'admin']));
        $employee = $this->employee();

        $this->get('/users/saveUser/'.$employee->id)->assertStatus(405);
        $this->assertSame(0, User::count());
        $this->assertSame(0, (int) $employee->fresh()->has_account);
    }

    public function test_initial_password_is_displayed_once_on_a_non_cacheable_page(): void
    {
        $this->actingAs((new User())->forceFill(['id' => 99, 'role' => 'admin']));
        $employee = $this->employee();
        $this->post(route('user.store', $employee->id))->assertRedirect();
        $password = session('new_account.password');

        $response = $this->get(route('addUser'))->assertOk()->assertSee($password);
        $this->assertStringContainsString('no-store', $response->headers->get('Cache-Control'));

        $this->get(route('addUser'))->assertOk()->assertDontSee($password);
    }

    public function test_no_account_is_created_without_a_department(): void
    {
        $this->actingAs((new User())->forceFill(['id' => 99, 'role' => 'admin']));
        $employee = $this->employee();
        $employee->doc_dept = null;
        $employee->save();

        $this->post(route('user.store', $employee->id))->assertSessionHas('echec');

        $this->assertSame(0, User::count());
        $this->assertSame(0, (int) $employee->fresh()->has_account);
    }

    public function test_an_existing_account_cannot_be_recreated(): void
    {
        $this->actingAs((new User())->forceFill(['id' => 99, 'role' => 'admin']));
        $employee = $this->employee();
        $this->post(route('user.store', $employee->id))->assertRedirect();
        $hash = User::firstOrFail()->password;

        $this->post(route('user.store', $employee->id))->assertSessionHas('echec');

        $this->assertSame(1, User::count());
        $this->assertSame($hash, User::firstOrFail()->password);
    }

    public function test_users_can_change_their_own_password(): void
    {
        $user = $this->account();
        $this->actingAs($user);

        $this->post(route('user.cpwd', $user->id), [
            'old_pwd' => 'OldPassword12345',
            'new_pwd' => 'NewPassword67890',
            'confirm_pwd' => 'NewPassword67890',
        ])->assertSessionHas('status');

        $this->assertTrue(Hash::check('NewPassword67890', $user->fresh()->password));
        $this->assertFalse(Hash::check('OldPassword12345', $user->fresh()->password));
    }

    #[DataProvider('invalidPasswords')]
    public function test_invalid_password_changes_preserve_the_existing_hash(
        string $oldPassword,
        string $newPassword,
        string $confirmation,
        ?string $validationField
    ): void {
        $user = $this->account();
        $hash = $user->password;
        $this->actingAs($user);

        $response = $this->from('/admin-profil-system')->post(route('user.cpwd', $user->id), [
            'old_pwd' => $oldPassword,
            'new_pwd' => $newPassword,
            'confirm_pwd' => $confirmation,
        ]);

        if ($validationField) {
            $response->assertSessionHasErrors($validationField);
        } else {
            $response->assertSessionHas('echec');
        }

        $this->assertSame($hash, $user->fresh()->password);
        foreach (['old_pwd', 'new_pwd', 'confirm_pwd'] as $field) {
            $this->assertNull(session('_old_input.'.$field));
        }
    }

    public static function invalidPasswords(): array
    {
        return [
            'too short' => ['OldPassword12345', 'Short123', 'Short123', 'new_pwd'],
            'missing numbers' => ['OldPassword12345', 'OnlyLettersHere', 'OnlyLettersHere', 'new_pwd'],
            'confirmation mismatch' => ['OldPassword12345', 'NewPassword67890', 'Different12345', 'confirm_pwd'],
            'same password' => ['OldPassword12345', 'OldPassword12345', 'OldPassword12345', 'new_pwd'],
            'incorrect old password' => ['WrongPassword123', 'NewPassword67890', 'NewPassword67890', null],
        ];
    }

    public function test_even_an_admin_cannot_change_another_users_password(): void
    {
        $target = $this->account();
        $hash = $target->password;
        $this->actingAs((new User())->forceFill(['id' => 99, 'role' => 'admin']));

        $this->post(route('user.cpwd', $target->id), [
            'old_pwd' => 'OldPassword12345',
            'new_pwd' => 'NewPassword67890',
            'confirm_pwd' => 'NewPassword67890',
        ])->assertForbidden();

        $this->assertSame($hash, $target->fresh()->password);
    }

    public function test_admin_seeder_requires_an_explicit_password(): void
    {
        $this->expectException(ValidationException::class);

        (new UserSeeder())->run();
    }

    public function test_admin_seeder_hashes_the_privately_supplied_password(): void
    {
        $command = Mockery::mock(Command::class);
        $command->shouldReceive('secret')->once()->andReturn('ChosenAdminPassword123');

        (new UserSeeder())->setCommand($command)->run();

        $admin = User::where('role', 'admin')->firstOrFail();
        $this->assertTrue(Hash::check('ChosenAdminPassword123', $admin->password));
    }

    private function employee(string $email = 'doctor@example.test'): Employee
    {
        $employee = (new Employee())->forceFill([
            'doc_fname' => 'Test', 'doc_lname' => 'Doctor',
            'doc_email' => $email, 'doc_dept' => 'doctor', 'has_account' => 0,
        ]);
        $employee->save();

        return $employee;
    }

    private function account(): User
    {
        $employee = $this->employee();
        $user = (new User())->forceFill([
            'name' => 'Doctor', 'email' => $employee->doc_email,
            'employee_id' => (string) $employee->id, 'role' => 'doctor',
            'password' => Hash::make('OldPassword12345'),
        ]);
        $user->save();

        return $user;
    }
}
