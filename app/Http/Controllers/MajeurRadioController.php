<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produit;
use App\Models\CmdDepot;
use App\Models\CommandeDepotSc;
use App\Models\DetailCmd;
use App\Models\DetailCommande;

class MajeurRadioController extends Controller
{
    // Affiche le formulaire de passage de commande
    public function passerCommande()
    {
        $produits = Produit::all();
        return view('majeur.commande_passer', compact('produits'));
    }

    // Enregistre la commande
    public function storeCommande(Request $request)
    {
        $request->validate([
            'date_cmd' => 'required|date',
            'depot_source_id' => 'required|exists:depots,id_depot',
            'depot_dest_id' => 'required|exists:depots,id_depot',
            'type_commande' => 'required|in:bon mensuelle,bon retour,bon échange,bon décharge,bon ordonnance,bon supplémentaire',
            'produit_id' => 'required|array|min:1',
            'produit_id.*' => 'required|exists:produits,id',
            'quantite' => 'required|array|min:1',
            'quantite.*' => 'required|integer|min:1',
        ]);

        // Création de la commande
        $commande = CommandeDepotSc::create([
            'id_depot_sc'         => 7, // ID du dépôt radiologie (exemple)
            'id_depot_principale' => 1, // ID du dépôt principal (exemple)
            'type_commande'       => $request->type_commande,
            'date_cmd'            => $request->date_cmd,
            'statut'              => 'en attente',
        ]);

        // Ajout des produits à la commande
        foreach ($request->produit_id as $index => $produitId) {
            \App\Models\DetailCommandeDepotSc::create([
                'id_cmd_sc'      => $commande->id_cmd_sc, // ou $commande->id selon ton modèle
                'id_produit'     => $produitId,
                'quantite_cmd'   => $request->quantite[$index],
            ]);
        }

        return redirect()->back()->with('success', 'Commande enregistrée avec succès.');
    }

    public function dashboard() {
        return view('majeur.dashboard');
    }
}