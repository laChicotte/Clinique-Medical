<?php

namespace App\Http\Controllers;
use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin')->only([
            'managePatientPage', 'editPatientPage', 'updatePatient', 'deletePatient',
        ]);
        $this->middleware('role:admin,doctor,laboratory,surgery')->except([
            'managePatientPage', 'editPatientPage', 'updatePatient', 'deletePatient',
        ]);
    }

    public function addPatientPage(){ return view('admin.patient.addPatient'); }
    public function freePatientPage(){ return view('admin.patient.freePatient'); }

    public function transferPatientPage(){
        $increment = 1; 
        $patients = Patient::get(); 
        return view('admin.patient.transferPatient')->with('patients', $patients)->with('increment', $increment); 
    }
    
    
    // Aafficher la gestion des patients
    public function managePatientPage(){ 
        $patient = Patient::get(); 
        $increment = 1;
        return view('admin.patient.managePatient')->with('patients', $patient)->with('increment', $increment);
    }

    // Voir les details d'un patient 
    public function detailsPatientPage($id){ 
        $patient = Patient::find($id); 

        return view('admin.patient.detailsPatient')->with('patient', $patient);
    }

    // formulaire de modification du patient 
    public function formTransferPatientPage($id){ 

        $patient = Patient::find($id); 

        return view('admin.patient.formTransferPatient')->with('patient', $patient);
    }


    // formulaire de modification du patient 
    public function editPatientPage($id){ 

        $patient = Patient::find($id); 

        return view('admin.patient.editPatient')->with('patient', $patient);
    }


    // Suppression d'un patient de la base
    public function deletePatient($id){ 
        $patient = Patient::find($id); 
        $patient->delete(); 

        return back()->with("status", "Votre patient a été supprimé avec succès");
    }
    

    // Voir tous les patients
    public function allPatientPage(){
        $patient = Patient::get(); 
        $increment = 1;
        return view('admin.patient.allPatient')->with('patients', $patient)->with('increment', $increment); 
    }
    
    // Validation du transfert du patient
    public function saveTransferPatient(Request $request, $id) {
        $this->validate($request, [
            't_hospital' => 'required|string', 
            't_date' => 'required|string',
        ]);
    
        $patient = Patient::find($id);

        $patient->pat_transferd_hospital = $request->input('t_hospital');
        $patient->pat_transferd_date = $request->input('t_date');
        
        $patient->pat_transfer_status = 1;

        $patient->update();
    
        return redirect("patients/transfer-patient")->with("status", "Votre patient a été transférés avec succès");
    }

    // Mettre à jour les infos un patient dans la base
    public function updatePatient(Request $request, $id) {
        $this->validate($request, [
            'pat_fname' => 'required|string', 
            'pat_lname' => 'required|string',
            'pat_dob' => 'required|date',
            'pat_age' => 'required|numeric',
            'pat_addr' => 'required|string',
            'pat_phone' => 'required|string',
            'pat_type' => 'required|string',
            'pat_ailment' => 'required|string',
        ]);
    
        $patient = Patient::find($id);

        $patient->pat_fname = $request->input('pat_fname');
        $patient->pat_lname = $request->input('pat_lname');
        $patient->pat_dob = $request->input('pat_dob');
        $patient->pat_addr = $request->input('pat_addr');
        $patient->pat_age = $request->input('pat_age');
        $patient->pat_phone = $request->input('pat_phone');
        $patient->pat_type = $request->input('pat_type');
        $patient->pat_ailment = $request->input('pat_ailment');

        $patient->update();
    
        return back()->with("status", "Vos informations ont été modifiées avec succès");
    }


    // Enregistrer un patient dans la base
    public function savePatient(Request $request) {
        $this->validate($request, [
            'pat_fname' => 'required|string', 
            'pat_lname' => 'required|string',
            'pat_dob' => 'required|date',
            'pat_age' => 'required|numeric',
            'pat_addr' => 'required|string',
            'pat_phone' => 'required|string',
            'pat_type' => 'required|string',
            'pat_ailment' => 'required|string',
        ]);
    
        $patient = new Patient();
        $patient->pat_fname = $request->input('pat_fname');
        $patient->pat_lname = $request->input('pat_lname');
        $patient->pat_dob = $request->input('pat_dob');
        $patient->pat_addr = $request->input('pat_addr');
        $patient->pat_age = $request->input('pat_age');
        $patient->pat_phone = $request->input('pat_phone');
        $patient->pat_type = $request->input('pat_type');
        $patient->pat_ailment = $request->input('pat_ailment');
        $patient->pat_number = strtoupper(substr(uniqid(), -5));

        $patient->save();
    
        return back()->with("status", "Votre patient a été enregistré avec succès");
    }
    
}
