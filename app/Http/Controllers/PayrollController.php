<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Payroll;

class PayrollController extends Controller
{
    // Fonction Salaires
    public function addPayrollPage(){ 
        $employees = Employee::get();
        return view('admin.payroll.addPayroll', compact('employees')); 
    }

    public function addPayrollFormPage($id){ 
        $employee = Employee::find($id);
        return view('admin.payroll.addPayrollForm', compact('employee')); 
    }

    public function savePayroll(Request $request) {
        // Valider les données du formulaire
        $request->validate([
            'pay_brut_salary' => 'required|numeric',
            'employee_id' => 'required|exists:employees,id',
            'pay_month' => 'required|integer|min:1|max:12',
            'pay_year' => 'required|integer|min:1000|max:9999', // Plage d'années raisonnable
        ]);
    
        // Créer une nouvelle fiche de paie
        $payroll = new Payroll();
        $payroll->employee_id = $request->input('employee_id');
        $payroll->pay_brut_salary = $request->input('pay_brut_salary');
        $payroll->pay_month = $request->input('pay_month');
        $payroll->pay_year = $request->input('pay_year');
    
        // Calcule des interets
        $netSalary = $payroll->pay_brut_salary * 0.8; // Par exemple, déduction de 20% pour le salaire net
        $payroll->pay_net_salary = $netSalary;
    
        // Enregistrer la fiche de paie
        $payroll->save();
    
        // Rediriger avec un message de succès
        return redirect()->back()->with('status', 'La fiche de paie a été ajoutée avec succès.');
    }
    

    public function printPayrollPage($id) {
        $payroll = Payroll::with('employee')->find($id);
        return view('admin.payroll.printPayroll', compact('payroll'));
    }
    public function managePayrollPage(){ 
        $payrolls = Payroll::with('employee')->get();
        return view('admin.payroll.managePayroll', compact('payrolls')); 
    }
}
