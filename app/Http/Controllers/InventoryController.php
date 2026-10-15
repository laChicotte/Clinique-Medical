<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Equipement;
use App\Models\Product;

class InventoryController extends Controller
{
    // fonctions inventaire
    public function inventoryProductPage(){ 

        $products = Product::with('category')->get();
        return view('admin.inventory.inventoryProduct', compact('products')); 
    }
    
    public function inventoryAssetPage(){ 
        $equipements = Equipement::with('vendor')->get();
        return view('admin.inventory.inventoryAsset', compact('equipements'));
    }
}
