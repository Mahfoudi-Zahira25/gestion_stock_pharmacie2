<?php

namespace App\Http\Controllers;

use App\Models\RetourProduit;
use App\Models\Depot;
use App\Models\Produit;
use App\Models\CommandeService;
use Illuminate\Http\Request;

class RetourProduitController extends Controller
{
    // Afficher la liste des retours de produits
    public function index()
    {
        $retours = RetourProduit::all(); // Récupérer tous les retours de produits
        return view('retourproduit.index', compact('retours'));
    }

    // Afficher le formulaire pour créer un nouveau retour de produit
    public function create()
    {
        // Récupérer les dépôts et les produits disponibles
        $depots = Depot::all(); // Récupérer tous les dépôts (dépôt principal et dépôts secondaires)
        $produits = Produit::all(); // Récupérer tous les produits
        return view('retourproduit.create', compact('depots', 'produits'));
    }

    // Enregistrer un nouveau retour de produit
    public function store(Request $request)
    {
        // Validation des données reçues
        $request->validate([
            'depot_id' => 'required|exists:depots,id',
            'produits' => 'required|array',
            'quantites' => 'required|array',
            'motif' => 'nullable|string|max:255',
        ]);

        // Création du retour de produit
        $retour = RetourProduit::create([
            'depot_id' => $request->depot_id,
            'motif' => $request->motif,
            'date_retour' => now(),
        ]);

        // Enregistrer les détails du retour (produits et quantités)
        foreach ($request->produits as $key => $produitId) {
            $quantite = $request->quantites[$key];

            // Mise à jour du stock du dépôt correspondant
            $produit = Produit::find($produitId);
            $produit->depot()->where('id', $request->depot_id)->increment('quantite', $quantite);

            // Enregistrer le détail du retour
            $retour->produits()->attach($produitId, ['quantite' => $quantite]);
        }

        return redirect()->route('retourproduit.index')->with('success', 'Retour de produit ajouté avec succès.');
    }

    // Afficher les détails d'un retour de produit spécifique
    public function show($id)
    {
        $retour = RetourProduit::findOrFail($id); // Trouver le retour de produit
        $produits = $retour->produits; // Récupérer les produits associés au retour
        return view('retourproduit.show', compact('retour', 'produits'));
    }

    // Afficher le formulaire d'édition d'un retour de produit
    public function edit($id)
    {
        $retour = RetourProduit::findOrFail($id); // Trouver le retour
        $depots = Depot::all(); // Récupérer tous les dépôts
        $produits = Produit::all(); // Récupérer tous les produits
        return view('retourproduit.edit', compact('retour', 'depots', 'produits'));
    }

    // Mettre à jour un retour de produit existant
    public function update(Request $request, $id)
    {
        // Validation des données
        $request->validate([
            'depot_id' => 'required|exists:depots,id',
            'produits' => 'required|array',
            'quantites' => 'required|array',
            'motif' => 'nullable|string|max:255',
        ]);

        // Récupérer le retour de produit existant
        $retour = RetourProduit::findOrFail($id);
        $retour->update([
            'depot_id' => $request->depot_id,
            'motif' => $request->motif,
            'date_retour' => now(),
        ]);

        // Supprimer les anciens produits associés et ajouter les nouveaux
        $retour->produits()->detach();

        // Ajouter les nouveaux produits au retour
        foreach ($request->produits as $key => $produitId) {
            $quantite = $request->quantites[$key];

            // Mise à jour du stock du dépôt
            $produit = Produit::find($produitId);
            $produit->depot()->where('id', $request->depot_id)->increment('quantite', $quantite);

            // Ajouter le produit au retour
            $retour->produits()->attach($produitId, ['quantite' => $quantite]);
        }

        return redirect()->route('retourproduit.index')->with('success', 'Retour de produit mis à jour avec succès.');
    }

    // Supprimer un retour de produit
    public function destroy($id)
    {
        $retour = RetourProduit::findOrFail($id);

        // Supprimer les produits associés
        $retour->produits()->detach();

        // Supprimer le retour de produit
        $retour->delete();

        return redirect()->route('retourproduit.index')->with('success', 'Retour de produit supprimé avec succès.');
    }
}
