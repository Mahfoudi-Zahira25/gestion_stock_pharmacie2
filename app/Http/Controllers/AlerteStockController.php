<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use Illuminate\Http\Request;

class AlerteStockController extends Controller
{
    // Afficher la liste des alertes de stock
    public function index()
    {
        // Récupérer les produits dont le stock est inférieur au seuil d'alerte
        $produitsEnAlerte = Produit::where('quantite', '<=', 'seuil_alerte')->get();

        return view('alertes_stock.index', compact('produitsEnAlerte'));
    }

    // Afficher les détails d'une alerte de stock pour un produit
    public function show($id)
    {
        $produit = Produit::findOrFail($id);
        
        return view('alertes_stock.show', compact('produit'));
    }

    // Gérer l'alerte de stock (par exemple, marquer un produit comme ayant été réapprovisionné)
    public function update(Request $request, $id)
    {
        $request->validate([
            'quantite' => 'required|integer|min:0',
        ]);

        $produit = Produit::findOrFail($id);

        // Mettre à jour la quantité de stock
        $produit->quantite = $request->quantite;
        $produit->save();

        // Rediriger avec un message de succès
        return redirect()->route('alertes_stock.index')->with('success', 'Stock mis à jour avec succès.');
    }

    // Supprimer une alerte (si nécessaire)
    public function destroy($id)
    {
        $produit = Produit::findOrFail($id);

        // Ici, on peut envisager de supprimer une alerte ou de remettre la quantité à la normale
        // Par exemple, si le stock est réapprovisionné, on peut supprimer l'alerte

        return redirect()->route('alertes_stock.index')->with('success', 'Alerte supprimée avec succès.');
    }
    
}
