<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Support\ImageUpload;
use App\Models\Employee;

class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin');
    }

    //    
    public function addEmployeePage(){ return view('admin.employee.addEmployee'); }

    public function transferEmployeePage($id){ 
        $employee = Employee::find($id);
        return view('admin.employee.transferEmployee')->with('employee', $employee); 
    }

    public function valideDepartementEmployee(Request $request, $id){
        
        $this->validate($request, [
            'doc_dept' => 'required|string',
        ]);

        $employee = Employee::find($id);
        $employee->doc_dept = $request->input('doc_dept');
        $employee->update();
    
        return back()->with("status", "Le département a été modifié(e) avec succès"); 
    }
    
    public function departEmployeePage(){ 
        $employees = Employee::get(); 
        $increment = 1;
        return view('admin.employee.departEmployee')->with('employees', $employees)->with('increment', $increment); 
    }

    // formulaire de modification de l'employee
    public function editEmployeePage($id){ 
        $employee = Employee::find($id);
        return view('admin.employee.editEmployee')->with('employee', $employee); 
    }
    
    public function manageEmployeePage(){ 
        $employees = Employee::get(); 
        $increment = 1;
        return view('admin.employee.manageEmployee')->with('employees', $employees)->with('increment', $increment);  
    }

    // Voir tous les employees
    public function allEmployeePage(){ 
        $employees = Employee::get(); 
        $increment = 1;
        return view('admin.employee.allEmployee')->with('employees', $employees)->with('increment', $increment); 
    }

    // Mettre à jour un employee dans la base
    public function updateEmployee(Request $request, $id) {

        $this->validate($request, [
            'doc_fname' => 'required|string', 
            'doc_lname' => 'required|string',
            'doc_email' => 'required|string',
            'doc_dpic' => ImageUpload::RULES,
        ]);
    
        $employee = Employee::findOrFail($id);
    
    
        $employee->doc_fname = $request->input('doc_fname');
        $employee->doc_lname = $request->input('doc_lname');
        $employee->doc_email = $request->input('doc_email');


        ImageUpload::save($employee, 'doc_dpic', $request->file('doc_dpic'), 'employeeProfiles', 'noimage.jpeg');
    
        return back()->with("status", "L'employé(e) a été modifié(e) avec succès"); 
    }

    // Enregistrer un employee dans la base
    public function saveEmployee(Request $request) {
        $this->validate($request, [
            'doc_fname' => 'required|string', 
            'doc_lname' => 'required|string',
            'doc_email' => 'required|string|unique:employees,doc_email',
            'doc_dpic' => ImageUpload::RULES,
        ]);
    
    
        $employee = new Employee();
    
        $employee->doc_fname = $request->input('doc_fname');
        $employee->doc_lname = $request->input('doc_lname');
        $employee->doc_email = $request->input('doc_email');
    
        $employee->doc_number = strtoupper(substr(uniqid(), -5));
        ImageUpload::save($employee, 'doc_dpic', $request->file('doc_dpic'), 'employeeProfiles', 'noimage.jpeg');
        
    
        return back()->with("status", "L'employé(e) a été enregistré avec succès"); 
    }

    // Voir les details d'un employee 
    public function detailsemployeePage($id){ 
        $employee = employee::find($id); 

        return view('admin.employee.detailsEmployee')->with('employee', $employee);
    }

    // Suppression d'un employé de la base
    public function deleteEmployee($id){ 
        $employee = Employee::findOrFail($id);
        $name = $employee->doc_fname.' '.$employee->doc_lname;
        $employee->delete(); 
        ImageUpload::delete('employeeProfiles', $employee->doc_dpic);

        return back()->with("status", "L'employé $name a été supprimé avec succès");
    }
    
    public function activateAccount($id)
    {
        // Trouver l'employé par ID
        $employee = Employee::find($id);
        // Vérifier si l'employé existe
        if (!$employee) {
            return false;
        }

        // Mettre à jour le champ 'has_account' à 1
        $employee->has_account = 1;
        $employee->save();

        // Retourner une réponse JSON ou une vue de confirmation
        return true;
    }

}
