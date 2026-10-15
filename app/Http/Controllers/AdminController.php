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


class AdminController extends Controller
{
    // Definition des chemins pour les dashboard
    public function viewHomePage(){ 
        return view('admin.home');
        
    }

    public function addUserPage(){ 
        $employees = Employee::where('has_account', 0)->get();
        return view('admin.user.addUser', compact('employees'));         
    }

    public function manageUserPage(){ 
         
        $users = User::get();
        return view('admin.user.manageUser', compact('users'));        
    }

    public function saveUser( $id){ 
    
        // Trouver l'employé par ID
        $employee = Employee::find($id);

        // Vérifier si l'employé existe
        if (!$employee) {
            return back()->with("echec", "L'employé n'a pas été trouvé.");
        }

        // Activer le compte de l'employé
        if ($employee->has_account === 0) {
            if($employee->doc_dept == null){
                return back()->with("echec", "Cet(te) employé(e) n'a pas de département");
            }
            // Créer un utilisateur ou mettre à jour les informations selon vos besoins
            $data = [
                'name' => $employee->doc_lname,
                'email' => $employee->doc_email,
                'employee_id' => strval($employee->id),
                'role' => $employee->doc_dept,
                'password' => Hash::make("motdepasse"),
            ];
            User::factory()->create($data);
            
            
            $employee->has_account = 1;
            $employee->save();

            return back()->with("status", "L'utilisateur a été enregistré avec succès");
        } else {
            return back()->with("echec", "Echec de l'enregistrement, vérifier si l'utilisateur a déjà un compte.");
        }
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
        // Valider les champs
        $request->validate([
            'new_pwd' => 'required',
            'old_pwd' => 'required'
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