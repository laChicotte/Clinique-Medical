<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use App\Models\Employee;
use App\Models\Patient;
use App\Models\Vendor;
use App\Models\Product;
use App\Models\Laboratory;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;


class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin')->only([
            'addUserPage', 'manageUserPage', 'saveUser', 'deleteUser',
            'managePasswordResetPage',
        ]);
        $this->middleware('role:admin,accounting,comptable')->only([
            'addAccountPayPage', 'manageAccountPayPage',
            'addAccountRecevPage', 'manageAccountRecevPage',
        ]);
        $this->middleware('role:admin,doctor')->only(['addRecordPage', 'manageRecordPage']);
    }

    // Definition des chemins pour les dashboard
    public function viewHomePage(){ 
        return view('admin.home');
        
    }

    public function addUserPage(){ 
        $employees = Employee::where('has_account', 0)->get();
        return response()->view('admin.user.addUser', compact('employees'))
            ->header('Cache-Control', 'no-store, private');
    }

    public function manageUserPage(){ 
         
        $users = User::get();
        return view('admin.user.manageUser', compact('users'));        
    }

    public function saveUser($id)
    {
        return DB::transaction(function () use ($id) {
            $employee = Employee::lockForUpdate()->find($id);

            if (!$employee) {
                return back()->with('echec', "L'employé n'a pas été trouvé.");
            }

            if ((int) $employee->has_account !== 0
                || User::where('employee_id', $employee->id)->exists()) {
                return back()->with('echec', "Cet employé a déjà un compte.");
            }

            if (!$employee->doc_dept) {
                return back()->with('echec', "Cet employé n'a pas de département.");
            }

            $password = Str::password(20);

            (new User())->forceFill([
                'name' => $employee->doc_lname,
                'email' => $employee->doc_email,
                'employee_id' => (string) $employee->id,
                'role' => $employee->doc_dept,
                'password' => Hash::make($password),
            ])->save();

            $employee->has_account = 1;
            $employee->save();

            return redirect()->route('addUser')
                ->with('status', "L'utilisateur a été enregistré avec succès.")
                ->with('new_account', ['email' => $employee->doc_email, 'password' => $password]);
        });
    }

    public function deleteUser($id){

        $user = User::find($id);

        $employee = Employee::find($user->employee_id);
        $employee->has_account = 0;

        $employee->save();
        
        
        $user->delete();

        

        // Redirection avec un message de succès
        return back()->with("status", "L'éutilisateur a été supprimé avec succès");
    }

    public function changePasswordUser(Request $request, $id)
    {
        // Each user can change only their own password, regardless of role.
        abort_unless((string) $request->user()->id === (string) $id, 403);

        // Valider les champs
        $request->validate([
            'new_pwd' => ['required', 'string', 'max:72', 'different:old_pwd', Password::min(12)->letters()->numbers()],
            'confirm_pwd' => ['required', 'string', 'same:new_pwd'],
            'old_pwd' => ['required', 'string'],
        ]);

        // Trouver l'utilisateur par son id
        $user = User::find($id);

        if (!$user) {
            return back()->with('echec', 'Utilisateur introuvable.');
        }

        // Vérifier si l'ancien mot de passe est correct
        if (Hash::check($request->old_pwd, $user->password)) {
            // Mettre à jour le mot de passe avec le nouveau
            $user->update([
                'password' => Hash::make($request->new_pwd)
            ]);

            $request->session()->regenerate();

            return back()->with("status", "Mot de passe modifié avec succès");
        } else {
            return back()->with("echec", "Ancien mot de passe incorrect");
        }
    }

     
    public function adminDashboardPage(){ 
        $employees = Employee::get(); 
        $in = Patient::where('pat_type', 'InPatient')->count();
        $out = Patient::where('pat_type', 'OutPatient')->count();
        $vendors = Vendor::count();
        $countLab = Laboratory::whereNull('lab_pat_results')->count();
        $products = Product::count();
        return view('admin.adminDashboard', compact('employees', 'in', 'out', 'products', 'vendors', 'countLab'));
        
    }

    public function adminLoginPage(){
        if(Auth::check()){
            // return view('dashboard');
            $employees = Employee::get(); 
            $in = Patient::where('pat_type', 'InPatient')->count();
            $out = Patient::where('pat_type', 'OutPatient')->count();
            $vendors = Vendor::count();
            $countLab = Laboratory::whereNull('lab_pat_results')->count();
            $products = Product::count();
            return view('admin.adminDashboard', compact('employees', 'in', 'out', 'products', 'vendors', 'countLab'));
            
        } 
        return view('admin.adminLogin');
    }

    public function adminLogOutPage(){ 
        Session::flush();
        Auth::logout();
        return view('admin.adminLogOut');
    }
    

    public function adminLoginPost(Request $request){ 
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
    
        $infos = $request->only('email', 'password');
    
        if(Auth::attempt($infos)){
            $request->session()->regenerate();
            return redirect()->intended(route('dashboard'));
        }
    
        return redirect()->route('loginAdmin')->with('error', "Email ou mot de passe incorrect");
    }
    

    public function doctorLoginPage(){ return view('admin.doctorLogin');}



    
    // fonctions pour la comptabilité 
    
    public function addAccountPayPage(){ return view('admin.account.addAccountPay'); }
    public function manageAccountPayPage(){ return view('admin.account.manageAccountPay'); }

    public function addAccountRecevPage(){ return view('admin.account.addAccountRecev'); }
    public function manageAccountRecevPage(){ return view('admin.account.manageAccountRecev'); }
    
    
    
    // fonctions Dossier
    public function addRecordPage(){ return view('admin.record.addRecord'); }
    public function manageRecordPage(){ return view('admin.record.manageRecord'); }
    
    
    public function managePasswordResetPage(){ return view('admin.managePasswordReset'); }
    public function adminMyProfilePage(){ return view('admin.adminMyProfile'); }
    
}
