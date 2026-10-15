<?php

namespace App\Http\Controllers;
use App\Models\Patient;
use App\Models\Prescription;
use App\Models\Laboratory;
use App\Models\Vital;
use App\Models\Employee;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin,pharmacy,pharmacie')->only('recordProductPage');
        $this->middleware('role:admin,accounting,comptable')->only('recordAccountPage');
        $this->middleware('role:admin,doctor')->except(['recordProductPage', 'recordAccountPage']);
    }

    // fonctions Rapports
    public function recordInPatientPage()
    {
        // Récupérer uniquement les patients dont le type est 'InPatient'
        $inPatients = Patient::where('pat_type', 'InPatient')->get();

        return view('admin.report.recordInPatient', compact('inPatients'));
    }

    public function recordOutPatientPage()
    {
        // Récupérer uniquement les patients dont le type est 'InPatient'
        $outPatients = Patient::where('pat_type', 'OutPatient')->get();

        return view('admin.report.recordOutPatient', compact('outPatients'));
    }

    public function viewRecordEmployeeProfilePage($id)
    {
        $employee = Employee::find($id);

        if (!$employee) {
            abort(404, 'Patient not found');
        }

        // Récupérer les signes vitaux du patient
        $vitals = $employee->vitals;

        // Retourner la vue avec les données du patient
        return view('admin.report.viewRecordEmployeeProfile', compact('employee', 'vitals'));
    }

    public function viewRecordPatientProfilePage($id)
    {
        $patient = Patient::find($id);

        if (!$patient) {
            abort(404, 'Patient not found');
        }

        // Récupérer les prescriptions du patient
        $prescriptions = $patient->prescriptions;

        // Récupérer les signes vitaux du patient
        $vitals = $patient->vitals;

        // Récupérer les enregistrements de laboratoire du patient
        $labs = $patient->laboratories;

        // Retourner la vue avec les données du patient
        return view('admin.report.viewRecordPatientProfile', compact('patient', 'prescriptions', 'vitals', 'labs'));
    }
    public function recordEmployeePage()
    {
        $employees = Employee::get();
        return view('admin.report.recordEmployee', compact('employees')); 
    }

    public function recordProductPage(){ return view('admin.report.recordProduct'); }
    public function recordMedicalPage(){
        $patients = Patient::get();
        return view('admin.report.recordMedical', compact('patients')); 
    }
    public function recordAccountPage(){ return view('admin.report.recordAccount'); }
}
