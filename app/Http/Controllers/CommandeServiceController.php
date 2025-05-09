<?php

namespace App\Http\Controllers;

use App\Models\CommandeService;
use App\Models\Depot;
use App\Models\DetailCommande;
use App\Models\Produit;
use App\Models\DetailCommandeService;
use Illuminate\Http\Request;

class CommandeServiceController extends Controller
{
    // Afficher la liste des commandes internes
    public function index()
    {
        $commandes = CommandeService::all(); // Récupérer toutes les commandes
        return view('commandeservice.index', compact('commandes'));
    }

    // Afficher le formulaire pour créer une nouvelle commande
    public function create()
    {
        // Récupérer les services (dépôts secondaires) et les produits disponibles
        $depots = Depot::where('type', 'service')->get(); // Filtrer pour les services
        $produits = Produit::all(); // Récupérer tous les produits
        return view('commandeservice.create', compact('depots', 'produits'));
    }

    // Enregistrer une nouvelle commande interne
    public function store(Request $request)
    {
        // Validation des données reçues
        $request->validate([
            'depot_id' => 'required|exists:depots,id',
            'produits' => 'required|array',
            'quantites' => 'required|array',
        ]);

        // Création de la commande interne
        $commande = CommandeService::create([
            'depot_id' => $request->depot_id,
            'date_commande' => now(),
            'status' => 'En cours', // Statut initial
        ]);

        // Enregistrer les détails de la commande (produits et quantités)
        foreach ($request->produits as $key => $produitId) {
            DetailCommande::create([
                'commande_service_id' => $commande->id,
                'produit_id' => $produitId,
                'quantite' => $request->quantites[$key],
            ]);
        }

        return redirect()->route('commandeservice.index')->with('success', 'Commande interne ajoutée avec succès.');
    }

    // Afficher les détails d'une commande spécifique
    public function show($id)
    {
        $commande = CommandeService::findOrFail($id); // Trouver la commande
        $details = DetailCommande::where('commande_service_id', $id)->get(); // Récupérer les détails
        return view('commandeservice.show', compact('commande', 'details'));
    }

    // Afficher le formulaire d'édition d'une commande
    public function edit($id)
    {
        $commande = CommandeService::findOrFail($id); // Trouver la commande
        $depots = Depot::where('type', 'service')->get(); // Récupérer les services
        $produits = Produit::all(); // Récupérer tous les produits
        $details = DetailCommande::where('commande_service_id', $id)->get(); // Détails de la commande
        return view('commandeservice.edit', compact('commande', 'depots', 'produits', 'details'));
    }

    // Mettre à jour une commande existante
    public function update(Request $request, $id)
    {
        // Validation des données reçues
        $request->validate([
            'depot_id' => 'required|exists:depots,id',
            'produits' => 'required|array',
            'quantites' => 'required|array',
        ]);

        // Récupérer la commande existante
        $commande = CommandeService::findOrFail($id);
        $commande->update([
            'depot_id' => $request->depot_id,
            'status' => 'En cours', // Statut à définir
        ]);

        // Supprimer les anciens détails et ajouter les nouveaux
        DetailCommande::where('commande_service_id', $id)->delete();

        // Ajouter les nouveaux détails
        foreach ($request->produits as $key => $produitId) {
            DetailCommande::create([
                'commande_service_id' => $commande->id,
                'produit_id' => $produitId,
                'quantite' => $request->quantites[$key],
            ]);
        }

        return redirect()->route('commandeservice.index')->with('success', 'Commande mise à jour avec succès.');
    }

    // Supprimer une commande
    public function destroy($id)
    {
        // Supprimer les détails associés à la commande
        DetailCommande::where('commande_service_id', $id)->delete();

        // Supprimer la commande elle-même
        CommandeService::destroy($id);

        return redirect()->route('commandeservice.index')->with('success', 'Commande supprimée avec succès.');
    }
}
