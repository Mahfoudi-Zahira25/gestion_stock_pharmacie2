<?php

namespace App\Http\Controllers;

use App\Models\SortieDepot;
use App\Models\Depot;
use App\Models\CommandeDepotSc;
use App\Models\DetailCommande;
use App\Models\DetailCommandeDepotSc;
use App\Models\DetailSortieDepot;
use App\Models\StockProduit;
use Illuminate\Http\Request;

class SortieDepotController extends Controller
{
    public function index()
    {
        $sorties = SortieDepot::with('depotSource', 'depotDestin')->get();
        return view('sortie_depots.index', compact('sorties'));
    }

    public function create()
    {
        $services = Depot::all();
        $types_commande = [
            'bon mensuelle',
            'bon retour',
            'bon échange',
            'bon décharge',
            'bon ordonnance', 
            'bon supplémentaire'
        ];
        $produits = \App\Models\Produit::all(); // Ajoute cette ligne

        return view('chef.sortie.service', compact('services', 'types_commande', 'produits'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'date_sortie' => 'required|date',
            'id_depot_source' => 'required|exists:depots,id_depot',
            'id_depot_destin' => 'required|exists:depots,id_depot',
        ]);

        SortieDepot::create($request->all());

        // Recharge les données nécessaires pour la vue
        $services = Depot::all();
        $commandes = CommandeDepotSc::all();

        return view('chef.sortie.service', compact('services', 'commandes'))
            ->with('success', 'Sortie dépôt créée avec succès.');
    }

    public function show(SortieDepot $sortieDepot)
    {
        return view('sortie_depots.show', compact('sortieDepot'));
    }

    public function edit(SortieDepot $sortieDepot)
    {
        return view('sortie_depots.edit', compact('sortieDepot'));
    }

    public function update(Request $request, SortieDepot $sortieDepot)
    {
        $request->validate([
            'date_sortie' => 'required|date',
            'id_depot_source' => 'required|exists:depots,id_depot',
            'id_depot_destin' => 'required|exists:depots,id_depot',
        ]);
        $sortieDepot->update($request->all());

        return redirect()->route('sortie_depots.index')->with('success', 'Sortie dépôt mise à jour avec succès.');
    }

    public function destroy(SortieDepot $sortieDepot)
    {
        $sortieDepot->delete();

        return redirect()->route('sortie_depots.index')->with('success', 'Sortie dépôt supprimée avec succès.');
    }

    public function form(Request $request)
    {
        $services = Depot::where('type', 'service')->get();
        $types_commande = ['interne', 'autre'];
        $commandeProduits = collect();
        $commande = null;

        // Si on a saisi un ID de commande secondaire
        if ($request->has('commande_ok')) {
            $commande_id = $request->commande_id;
            // Récupère la commande secondaire
            $commande = \App\Models\CommandeDepotSc::with('details.produit')->find($commande_id);

            // Récupère les produits de cette commande
            if ($commande) {
                $commandeProduits = $commande->details;
            }
        }
        return view('chef.sortie.service', compact('services', 'types_commande', 'commande', 'commandeProduits'));
    }

    public function serviceRecherche(Request $request)
    {
        $services = Depot::all();
        $types_commande = [
            'bon mensuelle',
            'bon retour',
            'bon échange',
            'bon décharge',
            'bon ordonnance', 
            'bon supplémentaire'
        ];

        $commande = null;
        $details = collect();

        if ($request->filled('commande_id')) {
            // Récupère la commande
            $commande = CommandeDepotSc::find($request->commande_id);

            // Récupère les détails de cette commande
            if ($commande) {
                $details = DetailCommandeDepotSc::where('id_cmd_sc', $commande->id_cmd_sc)
                    ->with('produit')
                    ->get();
            }
        }

        return view('chef.sortie.service', compact('services', 'types_commande', 'commande', 'details'));
    }

    public function enregistrer(Request $request)
    {
        $sortie = SortieDepot::create([
            'date_sortie'     => $request->input('date_sortie'),
            'id_depot_source' => $request->input('id_depot_source', 1),
            'id_depot_destin' => $request->input('id_depot_destin'),
        ]);

        if (!$sortie || !$sortie->id_sortie_depot) {
            return back()->with('error', 'Erreur lors de la création de la sortie.');
        }

        foreach ($request->quantite_sortie as $produitId => $qteSortie) {
            if ($qteSortie > 0) {
                DetailSortieDepot::create([
                    'id_sortie_depot' => $sortie->id_sortie_depot,
                    'id_produit' => $produitId,
                    'quantite' => $qteSortie,
                ]);
            }
        }

        // Stocke l'ID de la dernière sortie en session
        session(['last_sortie_id' => $sortie->id_sortie_depot]);

        // Redirige vers la même page avec un message de succès
        return redirect()->back()->with('success', 'Sortie enregistrée avec succès.');
    }

    public function bonLivraison($id)
    {
        $sortie = SortieDepot::with('details.produit', 'service')->findOrFail($id);
        return view('chef.sortie.bon_livraison_service', compact('sortie'));
    }

    public function commandesTraitees()
    {
        // Exemple : récupère toutes les commandes déjà traitées (statut = 'livrée')
        $commandes = \App\Models\CommandeDepotSc::where('statut', 'livrée')->orderBy('date_cmd', 'desc')->get();

        return view('chef.sortie.commandes_traitees', compact('commandes'));
    }
}
