<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Patient;
use App\Models\Laboratory;
use App\Models\Equipement;
use App\Models\Employee;
use App\Models\Vital; 
use App\Models\Vendor;
use Illuminate\Support\Facades\Auth;


class LaboratoryController extends Controller
{
    
    public function labPatientTestPage()
    { 
        $patients = Patient::get();

        return view('admin.labo.labPatientTest', compact('patients')); 
    }

    public function labDetailsPatientTestPage($id){ 
        
        $patient = Patient::find($id);

        return view('admin.labo.labDetailsPatientTest', ['patient' => $patient]); 
    }

    public function labDetailsPatientResultPage($id){ 
        
        $laboratory = Laboratory::with('patient')->find($id);

        return view('admin.labo.labDetailsPatientResult', ['laboratory' => $laboratory]); 
    }

    public function resultLaboratory(Request $request, $id)
    {
        // Valider les données du formulaire
        $request->validate([
            'lab_pat_results' => 'required',
        ]);

        // Créer une nouvelle laboratory
        $laboratory = Laboratory::find($id);

        
        $laboratory->lab_pat_results = $request->lab_pat_results;

        $laboratory->update();

        // Rediriger avec un message de succès
        return redirect()->back()->with('status', 'Le résultat de l\'examen a été ajoutée avec succès.');
    }

    public function saveLaboratory(Request $request)
    {
        // Valider les données du formulaire
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'lab_pat_tests' => 'required',
        ]);

        // Créer une nouvelle laboratory
        $laboratory = new Laboratory();
        $laboratory->patient_id = $request->patient_id;
        $laboratory->lab_pat_tests = $request->lab_pat_tests;
        $laboratory->employee_id = Auth::user()->employee_id;
        $laboratory->save();

        // Rediriger avec un message de succès
        return redirect()->back()->with('status', 'L\'examen a été ajoutée avec succès.');
    }

    // fonctions laboratoires
    public function manageLabEquipementPage(){ 
        // Récupérer les équipements où le département est "Laboratory"
        $labEquipments = Equipement::where('eqp_dept', 'Laboratory')->with('vendor')->get();
        return view('admin.labo.manageLabEquipement', compact('labEquipments')); 
    }

    // fonctions laboratoires
    public function labDetailsEquipementPage($id){ 
        // Récupérer les équipements où le département est "Laboratory"
        // $img = Storage::url('equipements/' . $equipement->eqp_dpic);
        $equipement = Equipement::with('vendor')->find($id);
        return view('admin.labo.labDetailsEquipement', compact('equipement')); 
    }

    // fonctions laboratoires
    public function editLabEquipementPage($id){ 
        // Récupérer les équipements où le département est "Laboratory"
        $equipement = Equipement::with('vendor')->find($id);
        $vendors = Vendor::get();
        return view('admin.labo.editLabEquipement', compact('equipement', 'vendors')); 
    }

    public function labPatientVitalPage()
    { 
        $patients = Patient::get(); 
        return view('admin.labo.labPatientVital', compact('patients')); 
    }

    public function labPatientResultPage()
    {
        $tests = Laboratory::with('patient')->get();
        return view('admin.labo.labPatientResult', compact('tests'));
         
    }
    public function addLabEmployeeVitalPage($id){
        $employee = Employee::find($id); 
        return view('admin.labo.addLabEmployeeVital', compact('employee')); 

    }

    public function addLabPatientVitalPage($id){
        $patient = Patient::find($id); 
        return view('admin.labo.addLabPatientVital', compact('patient')); 

    }


    public function saveEmployeeVital(Request $request)
    {
        $request->validate([
            'vit_bodytemp' => 'required',
            'vit_heartpulse' => 'required',
            'vit_resprate' => 'required',
            'vit_bloodpress' => 'required',
            'employee_id' => 'required|exists:employees,id',
        ]);


        $vital = new Vital();
        $vital->vit_bodytemp = $request->input('vit_bodytemp');
        $vital->vit_heartpulse = $request->input('vit_heartpulse');
        $vital->vit_resprate = $request->input('vit_resprate');
        $vital->vit_bloodpress = $request->input('vit_bloodpress');
        $vital->vit_type = 'employee';
        $vital->employee_id = $request->input('employee_id');
        $vital->save();

        return redirect()->back()->with('status', 'Les signes vitaux du patient ont été enregistrés avec succès.');

    }

    public function savePatientVital(Request $request)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'vit_bodytemp' => 'required',
            'vit_heartpulse' => 'required',
            'vit_resprate' => 'required',
            'vit_bloodpress' => 'required',
        ]);


        $vital = new Vital();
        $vital->vit_bodytemp = $request->input('vit_bodytemp');
        $vital->vit_heartpulse = $request->input('vit_heartpulse');
        $vital->vit_resprate = $request->input('vit_resprate');
        $vital->vit_bloodpress = $request->input('vit_bloodpress');
        $vital->vit_type = 'patient';
        $vital->patient_id = $request->input('patient_id');
        $vital->save();

        return redirect()->back()->with('status', 'Les signes vitaux de l\'employé ont été enregistrés avec succès.');

    }
 
    public function labEmployeeVitalPage()
    { 
        $employees = Employee::get(); 
        return view('admin.labo.labEmployeeVital', compact('employees')); 
    }

    public function addLabEquipementPage(){
        // Récupérer la liste des fournisseurs
        $vendors = Vendor::all();
        // Passer la liste des fournisseurs à la vue
        return view('admin.labo.addLabEquipement', ['vendors' => $vendors]); 
    }

    public function labReportPage()
    { 
        $tests = Laboratory::with('patient')->get();
        return view('admin.labo.labReport', compact('tests'));
    }

    public function labRecordPage($id)
    {

        $tests = Laboratory::with('patient')->find($id);
        return view('admin.labo.labRecord', compact('tests'));
    }

    public function updateEquipement(Request $request, $id)
    {
        // Validation des données entrées par l'utilisateur
        $validatedData = $request->validate([
            'eqp_name' => 'required|string',
            'vendor_id' => 'required|exists:vendors,id',
            'eqp_qty' => 'required|integer',
            'eqp_dpic' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'eqp_code' => 'required|string|max:8',
            'eqp_desc' => 'required|string',
            'eqp_status' => 'required|string',
        ]);

        // Création d'un nouvel équipement
        $equipement = Equipement::find($id);
        $equipement->eqp_name = $validatedData['eqp_name'];
        $equipement->vendor_id = $validatedData['vendor_id'];
        $equipement->eqp_qty = $validatedData['eqp_qty'];
        $equipement->eqp_code = $validatedData['eqp_code'];
        $equipement->eqp_status = $validatedData['eqp_status'];
        $equipement->eqp_desc = $validatedData['eqp_desc'];

        // Vérification si une photo a été téléchargée
        if ($request->file('eqp_dpic')) {
            $fileNameWithExt = $request->file('eqp_dpic')->getClientOriginalName();

            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

            $ext = $request->file('eqp_dpic')->getClientOriginalExtension(); 

            $fileNameToStore = $fileName.'_'.time().'.'.$ext;

            // Suprrimer l'ancienne image
            Storage::delete("public/equipements/$equipement->eqp_dpic");

            // Déplacement du fichier téléchargé vers le dossier de stockage
            $path = $request->file('eqp_dpic')->storeAs('public/equipements', $fileNameToStore);
            
            // Stockage du nom de fichier dans la base de données
            $equipement->eqp_dpic = $fileNameToStore;
        } else {
            // Utilisation d'une image par défaut si aucune image n'est téléchargée
            $equipement->eqp_dpic = "nolabimage.jpeg";
        }

        // Enregistrement de l'équipement dans la base de données
        $equipement->update();

        // Redirection avec un message de succès
        return back()->with("status", "L'équipement a été mis à jour avec succès");
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
        $equipement->eqp_dept = "Laboratory";
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
        return back()->with("status", "L'équipement a été ajouté avec succès");
    }

    public function deleteEquipement($id){
        // Recherche de l'équipement à supprimer
        $equipement = Equipement::find($id);
        
        // Suprrimer l'ancienne image
        Storage::delete("public/equipements/$equipement->eqp_dpic");
        // Suppression de l'équipement
        $equipement->delete();
    
        // Redirection avec un message de succès
        return back()->with("status", "L'équipement a été supprimé avec succès");
    }


}
