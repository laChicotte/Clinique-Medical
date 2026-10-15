<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin');
    }


    // Fonction fournisseurs
    public function addVendorPage(){ return view('admin.vendor.addVendor'); }

    public function editVendorPage($id){ 
        $vendor = Vendor::find($id);
        return view('admin.vendor.editVendor')->with("vendor", $vendor);
    }

    public function detailVendorPage($id){ 
        $vendor = Vendor::find($id);
        return view('admin.vendor.detailsVendor')->with("vendor", $vendor); 
    }


    public function manageVendorPage(){ 
        $vendors = Vendor::get();
        $increment = 1;
        return view('admin.vendor.manageVendor')->with("vendors", $vendors)->with("increment", $increment); 
    }

    // Enregistrer un vendor dans la base
    public function saveVendor(Request $request) {
        // Validation des données entrées par l'utilisateur
        $validatedData = $request->validate([
            'v_name' => 'required|string', 
            'v_email' => 'required|string',
            'v_addr' => 'required|string',
            'v_phone' => 'required|string',
            'v_desc' => 'required|string',
        ]);
    
        // Création d'un nouvel objet Vendor et attribution des valeurs des champs
        $vendor = new Vendor();
        $vendor->v_name = $validatedData['v_name'];
        $vendor->v_email = $validatedData['v_email'];
        $vendor->v_addr = $validatedData['v_addr'];
        $vendor->v_phone = $validatedData['v_phone'];
        $vendor->v_desc = $validatedData['v_desc'];
    
        // Génération d'un numéro de vendor unique
        $vendor->v_number = strtoupper(substr(uniqid(), -5));
    
        // Enregistrement du vendor dans la base de données
        $vendor->save();
    
        // Redirection avec un message de succès
        return back()->with("status", "Votre vendor a été enregistré avec succès");
    }

    public function updateVendor(Request $request, $id) {

        // Validation des données entrées par l'utilisateur
        $validatedData = $request->validate([
            'v_name' => 'required|string', 
            'v_email' => 'required|string',
            'v_addr' => 'required|string',
            'v_phone' => 'required|string',
            'v_desc' => 'required|string',
        ]);
    
        // Récupération du fournisseur à mettre à jour
        $vendor = Vendor::find($id);
    
        // Attribution des nouvelles valeurs aux champs du fournisseur
        $vendor->v_name = $validatedData['v_name'];
        $vendor->v_email = $validatedData['v_email'];
        $vendor->v_addr = $validatedData['v_addr'];
        $vendor->v_phone = $validatedData['v_phone'];
        $vendor->v_desc = $validatedData['v_desc'];
    
        // Enregistrement des modifications dans la base de données
        $vendor->update();
    
        // Redirection avec un message de succès
        return back()->with("status", "Le fournisseur a été mis à jour avec succès");
    }
    

    public function deleteVendor($id) {
        // Récupération du fournisseur à supprimer
        $vendor = Vendor::find($id);
    
        // Suppression du fournisseur
        $vendor->delete();
    
        // Redirection avec un message de succès
        return back()->with("status", "Le fournisseur a été supprimé avec succès");
    }
    
    
}
