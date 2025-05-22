<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use Illuminate\Http\Request;

class ChefPharmacieController extends Controller
{
   
   

public function index()
{
    $totalProduits = Produit::count(); // Compter tous les produits

    // Autres statistiques éventuelles...
    
    return view('chef.dashboard', [
        'totalProduits' => $totalProduits,
        // Autres variables à passer...
    ]);
    }
}
