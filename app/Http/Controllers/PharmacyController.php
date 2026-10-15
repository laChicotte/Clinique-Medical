<?php

namespace App\Http\Controllers;
use App\Models\Vendor;
use App\Models\Category;
use App\Models\Product;
use App\Models\Patient;
use App\Models\Prescription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PharmacyController extends Controller
{
    public function __construct()
    {
        $prescriptionMethods = [
            'addPrescriptionPage', 'addDetailsPrescriptionPage', 'savePrescription',
            'showPrescription', 'editPrescriptionPage', 'updatePrescription',
            'deletePrescription', 'managePrescriptionPage', 'allPrescriptionPage',
        ];

        $this->middleware('role:admin,doctor')->only($prescriptionMethods);
        $this->middleware('role:admin,pharmacy,pharmacie')->except($prescriptionMethods);
    }

    public function addCatProductPage()
    {
        // Récupérer la liste des fournisseurs
        $vendors = Vendor::all();

        // Passer la liste des fournisseurs à la vue
        return view('admin.pharmacy.addCatProduct', ['vendors' => $vendors]);
    }


    public function saveCategory(Request $request)
    {
        // Validation des données entrées par l'utilisateur
        $validatedData = $request->validate([
            'pharm_cat_name' => 'required|string', 
            'vendor_id' => 'required|exists:vendors,id',
            'pharm_cat_desc' => 'required|string',
        ]);

        // Création d'une nouvelle catégorie et attribution des valeurs des champs
        $category = new Category();
        $category->pharm_cat_name = $validatedData['pharm_cat_name'];
        $category->vendor_id = $validatedData['vendor_id'];
        $category->pharm_cat_desc = $validatedData['pharm_cat_desc'];

        // Enregistrement de la catégorie dans la base de données
        $category->save();

        // Redirection avec un message de succès
        return back()->with("status", "La catégorie a été ajoutée avec succès");
    }

    public function showProductPage($id){
        // Récupérer la catégorie correspondant à l'ID fourni avec son fournisseur
        $product = Product::with('category')->find($id);

        // Afficher la vue des détails de la catégorie en passant la catégorie récupérée
        return view('admin.pharmacy.detailsProduct', compact('product'));
    }


    public function showCategory($id){
        // Récupérer la catégorie correspondant à l'ID fourni avec son fournisseur
        $category = Category::with('vendor')->find($id);

        // Afficher la vue des détails de la catégorie en passant la catégorie récupérée
        return view('admin.pharmacy.detailsCatProduct', compact('category'));
    }

    public function udateCategory(Request $request, $id)
    {
        // Récupérer la catégorie à mettre à jour
        $category = Category::find($id);

        // Vérifier si la catégorie existe
        if (!$category) {
            return redirect()->back()->withErrors(['La catégorie n\'existe pas.']);
        }

        // Mettre à jour les propriétés de la catégorie
        $category->update([
            'pharm_cat_name' => $request->input('pharm_cat_name'),
            // Autres propriétés à mettre à jour...
        ]);

        // Rediriger avec un message de succès
        return redirect()->route('category.edit', $id)->with('status', 'La catégorie a été mise à jour avec succès.');
    }

    public function manageCatProductPage()
    {
        // Récupérer toutes les catégories depuis la base de données avec la relation 'vendor' chargée
        $categories = Category::with('vendor')->get();

        // Passer les catégories à la vue
        return view('admin.pharmacy.manageCatProduct', ['categories' => $categories]);
    }

    
    
    public function deleteCategory($id)
    {
        // Récupérer la catégorie spécifiée par son ID depuis la base de données
        $category = Category::find($id);

        // Vérifier si la catégorie existe
        if (!$category) {
            // Rediriger avec un message d'erreur si la catégorie n'existe pas
            return redirect()->back()->with('error', 'La catégorie spécifiée n\'existe pas.');
        }

        // Supprimer la catégorie de la base de données
        $category->delete();
        
        return redirect()->back()->with('success', 'La catégorie a été supprimée avec succès.');
    }

    public function allCatProductPage()
    {
        // Récupérer toutes les catégories depuis la base de données avec la relation 'vendor' chargée
        $categories = Category::with('vendor')->get();

        // Passer les catégories à la vue
        return view('admin.pharmacy.allCatProduct', ['categories' => $categories]);
    }

    public function editProductPage($id)
    {
        $product = Product::with('category')->find($id);
        $categories = Category::where('id', '!=', $product->category_id)->get();

        return view('admin.pharmacy.editProduct', ['product' => $product, 'categories' => $categories]);
    }
    
    public function editCatProductPage($id)
    {
        // Récupérer la catégorie depuis la base de données avec la relation 'vendor' chargée
        $category = Category::with('vendor')->find($id);
        
        // Récupérer tous les fournisseurs sauf celui de la catégorie actuelle
        $vendors = Vendor::where('id', '!=', $category->vendor_id)->get();
        
        // Passer la catégorie et les fournisseurs à la vue
        return view('admin.pharmacy.editCatProduct', ['category' => $category, 'vendors' => $vendors]);
    }
    
    public function updateCategory(Request $request, $id)
    {
        // Valider les données du formulaire
        $validatedData = $request->validate([
            'pharm_cat_name' => 'required|string',
            'vendor_id' => 'required|exists:vendors,id',
            'pharm_cat_desc' => 'required|string',
        ]);
        
        // Récupérer la catégorie à partir de l'ID
        $category = Category::find($id);
        
        // Mettre à jour les informations de la catégorie
        $category->pharm_cat_name = $validatedData['pharm_cat_name'];
        $category->vendor_id = $validatedData['vendor_id'];
        $category->pharm_cat_desc = $validatedData['pharm_cat_desc'];
        $category->update();
        
        // Rediriger avec un message de succès
        return redirect()->back()->with('status', 'La catégorie pharmaceutique a été mise à jour avec succès.');
    }
    
    
    // fonctions pour les prosuits
    public function deleteProduct($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return redirect()->back()->with('error', 'La catégorie spécifiée n\'existe pas.');
        }

        $product->delete();

        // Rediriger avec un message de succès
        return redirect()->back()->with('status', 'La catégorie a été supprimée avec succès.');
    }


    public function addProductPage(){ 
        // Récupérer la liste des fournisseurs
        $categories = Category::all();

        return view('admin.pharmacy.addProduct', ['categories' => $categories]); 
    }

    public function saveProduct(Request $request)
    {
        // Validation des données entrées par l'utilisateur
        $request->validate([
            'phar_name' => 'required|string|max:255',
            'phar_bcode' => 'required|string|unique:products|max:255',
            'phar_desc' => 'required|string',
            'phar_qty' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id', // Vérifie que la catégorie existe dans la table 'categories'
        ]);

        // Création d'un nouveau produit avec les données validées
        $product = new Product([
            'phar_name' => $request->input('phar_name'),
            'phar_bcode' => $request->input('phar_bcode'),
            'phar_desc' => $request->input('phar_desc'),
            'phar_qty' => $request->input('phar_qty'),
            'category_id' => $request->input('category_id'),
        ]);

        // Enregistrement du produit dans la base de données
        $product->save();

        // Redirection avec un message de succès
        return redirect()->back()->with('status', 'Le produit a été ajouté avec succès.');

    }

    public function updateProduct(Request $request, $id)
    {
        // Valider les données du formulaire
        $request->validate([
            'phar_name' => 'required|string|max:255',
            'phar_bcode' => 'required|string|max:255',
            'phar_desc' => 'nullable|string',
            'phar_qty' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
        ]);

        // Trouver le produit à mettre à jour
        $product = Product::find($id);

        // Mettre à jour les informations du produit
        $product->update([
            'phar_name' => $request->phar_name,
            'phar_bcode' => $request->phar_bcode,
            'phar_desc' => $request->phar_desc,
            'phar_qty' => $request->phar_qty,
            'category_id' => $request->category_id,
        ]);

        // Rediriger avec un message de succès
        return redirect()->back()->with('status', 'Le produit a été mis à jour avec succès.');
    }

    public function manageProductPage(){ 

        $products = Product::with('category')->get();
        // Passer les produits à la vue
        return view('admin.pharmacy.manageProduct', ['products' => $products]);
    }

    public function allProductPage()
    {
        // Récupérer tous les produits depuis la base de données avec la relation 'category' chargée
        $products = Product::with('category')->get();

        // Passer les produits à la vue
        return view('admin.pharmacy.allProduct', ['products' => $products]);
    }


    // fonction pour les ordonnaces
    public function addPrescriptionPage(){ 
        $patients = Patient::get();

        return view('admin.pharmacy.addPrescription', ['patients' => $patients]); 
    }
    
    public function addDetailsPrescriptionPage($id){ 
        $patient = Patient::find($id);

        return view('admin.pharmacy.addDetailsPrescription', ['patient' => $patient]); 
    }

    public function savePrescription(Request $request)
    {
        // Valider les données du formulaire
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'pres_ins' => 'required|string',
        ]);

        // Créer une nouvelle prescription
        $prescription = new Prescription();
        $prescription->patient_id = $request->patient_id;
        $prescription->pres_ins = $request->pres_ins;
        $prescription->employee_id = Auth::user()->employee_id;
        $prescription->save();

        // Rediriger avec un message de succès
        return redirect()->back()->with('status', 'La prescription a été ajoutée avec succès.');
    }

    public function updatePrescription(Request $request, $id)
    {
        // Valider les données du formulaire
        $request->validate([
            'pres_ins' => 'required|string',
        ]);

        // Créer une nouvelle prescription
        $prescription = Prescription::find($id);

        $prescription->pres_ins = $request->pres_ins;
        $prescription->update();

        // Rediriger avec un message de succès
        return redirect()->back()->with('status', 'La prescription a été mise à jour avec succès.');
    }

    public function editPrescriptionPage($id)
    {
        $prescription = Prescription::with('patient')->find($id);
        return view('admin.pharmacy.editPrescription', compact('prescription'));
    }

    public function managePrescriptionPage()
    {
        $prescriptions = Prescription::with('patient')->get();
        return view('admin.pharmacy.managePrescription', compact('prescriptions'));
    }

    function showPrescription($id)  {

        $prescription = Prescription::with('patient')->find($id);

        return view('admin.pharmacy.detailsPrescription', compact('prescription'));      
    }

    public function allPrescriptionPage()
    {
        $prescriptions = Prescription::with('patient')->get();
        return view('admin.pharmacy.allPrescription', compact('prescriptions')); 
    }

    public function deletePrescription($id)
    {
        $prescription = Prescription::find($id);

        if (!$prescription) {
            return redirect()->back()->with('error', 'L\'ordonnance spécifiée n\'existe pas.');
        }

        $prescription->delete();

        // Rediriger avec un message de succès
        return redirect()->back()->with('status', 'L\'ordonnance a été supprimée avec succès.');
    }
}
