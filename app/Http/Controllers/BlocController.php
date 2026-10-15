<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Equipement;
use App\Models\Vendor;
use App\Models\Patient;
use App\Models\Employee;
use App\Models\Surgery;

class BlocController extends Controller
{
    
    // fonctions bloc operatoire
    public function addBlocPatientPage(){
        $patients = Patient::get();
        return view('admin.bloc.addBlocPatient', compact('patients')); 
    }

    public function editBlocPatientPage($id){
        $surgery = Surgery::find($id);
        return view('admin.bloc.editBlocPatient', compact('surgery')); 
    }

    public function updateSurgery(Request $request, $id)
    {
        // Validation des données entrées par l'utilisateur
        $validatedData = $request->validate([
            'su_name' => 'required|string',
            'su_status' => 'required|in:Undergoing,Successful',
        ]);

        // Recherche de la chirurgie à mettre à jour
        $surgery = Surgery::findOrFail($id);

        // Mise à jour des données de la chirurgie
        $surgery->su_name = $validatedData['su_name'];
        $surgery->su_status = $validatedData['su_status'];
        $surgery->save();

        // Redirection avec un message de succès
        return redirect()->route('manage.patient.bloc')->with("status", "La chirurgie a été mise à jour avec succès");
    }

    public function deleteSurgery($id)
    {
        // Recherche de la chirurgie à supprimer
        $surgery = Surgery::findOrFail($id);

        // Suppression de la chirurgie
        $surgery->delete();

        // Redirection avec un message de succès
        return back()->with("status", "La chirurgie a été supprimée avec succès");
    }

    
    
    public function manageBlocPatientPage(){
        $surgeries = Surgery::with('patient', 'employee')->get();
        return view('admin.bloc.manageBlocPatient', compact('surgeries')); 


    }
    
    public function addBlocPatientFormPage($id){
        $patient = Patient::find($id);
        $employees = Employee::get();
        return view('admin.bloc.addBlocPatientForm', compact('patient', 'employees')); 
    }

    
    public function saveSurgery(Request $request)
    {
        // Valider les données du formulaire
        $validatedData = $request->validate([
            'su_name' => 'required|string',
            'patient_id' => 'required|exists:patients,id',
            'employee_id' => 'required|exists:employees,id',
        ]);

        // Créer une nouvelle chirurgie avec les données validées
        $surgery = new Surgery();
        $surgery->su_name = $validatedData['su_name'];
        $surgery->patient_id = $validatedData['patient_id'];
        $surgery->employee_id = $validatedData['employee_id'];
        $surgery->su_status = "Undergoing";
        $surgery->save();

        // Rediriger avec un message de succès
        return redirect()->route('manage.patient.bloc')->with('status', 'La chirurgie a été enregistrée avec succès.');
    }

    public function addBlocEquipementPage(){ 
        $vendors = Vendor::all();
        return view('admin.bloc.addBlocEquipement', compact('vendors')); 
    }


    public function manageBlocEquipementPage(){ 
        // Récupérer les équipements où le département est "Surgery"
        $labEquipments = Equipement::where('eqp_dept', 'Surgery')->with('vendor')->get();
        return view('admin.bloc.manageBlocEquipement', compact('labEquipments')); 
    }

    public function blocRecordPage(){ 
        $surgeries = Surgery::with('patient', 'employee')->get();
        return view('admin.bloc.blocRecord', compact('surgeries')); 
    }

    public function saveEquipement(Request $request)
    {
        // Validation des données entrées par l'utilisateur
        $validatedData = $request->validate([
            'eqp_name' => 'required|string',
            'vendor_id' => 'required|exists:vendors,id',
            'eqp_qty' => 'required|string',
            'eqp_dpic' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'eqp_code' => 'required|string|max:8',
            'eqp_desc' => 'required|string',
        ]);

        // Création d'un nouvel équipement
        $equipement = new Equipement();
        $equipement->eqp_name = $validatedData['eqp_name'];
        $equipement->vendor_id = $validatedData['vendor_id'];
        $equipement->eqp_qty = $validatedData['eqp_qty'];
        $equipement->eqp_code = $validatedData['eqp_code'];
        $equipement->eqp_dept = "Surgery";
        $equipement->eqp_status = "Working";
        $equipement->eqp_desc = $validatedData['eqp_desc'];

        // Vérification si une photo a été téléchargée
        if ($request->file('eqp_dpic')) {
            $fileNameWithExt = $request->file('eqp_dpic')->getClientOriginalName();

            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

            $ext = $request->file('eqp_dpic')->getClientOriginalExtension(); 

            $fileNameToStore = $fileName.'_'.time().'.'.$ext;

            // Déplacement du fichier téléchargé vers le dossier de stockage
            $path = $request->file('eqp_dpic')->storeAs('public/equipements', $fileNameToStore);
            
            // Stockage du nom de fichier dans la base de données
            $equipement->eqp_dpic = $fileNameToStore;
        } else {
            // Utilisation d'une image par défaut si aucune image n'est téléchargée
            $equipement->eqp_dpic = "nolabimage.jpeg";
        }

        // Enregistrement de l'équipement dans la base de données
        $equipement->save();

        // Redirection avec un message de succès
        return redirect()->route('manage.equipement.bloc')->with("status", "L'équipement a été ajouté avec succès");
    }

    public function viewDetailBlocPatientPage($id){
        $surgery = Surgery::with('patient', 'employee')->find($id);
        return view('admin.bloc.viewDetailBlocPatient', compact('surgery')); 
    }

}
