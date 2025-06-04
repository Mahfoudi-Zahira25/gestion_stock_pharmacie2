<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produit;
use App\Models\CmdDepot; // <-- Utilise CmdDepot
use App\Models\CommandeDepotSc;
use Illuminate\Support\Facades\DB;
use App\Models\StockProduit;

class ChefPharmacieController extends Controller
{
    public function dashboard() // <-- ici, remplace "index" par "dashboard"
    {
        $nbrProduits = Produit::count();
        $nbrCommandes = CommandeDepotSc::count(); // <-- Compte les commandes dans cmd_depot
        $nbrAlertes = 0;
        $nbrActivites = 0;

        // Nombre de produits en alerte (quantité < stock_alerte)
        $nbrAlertes = DB::table('stock_produits')
            ->whereColumn('quantite', '<', 'stock_alerte')
            ->count();

        return view('chef.dashboard', [
            'nbrProduits' => $nbrProduits,
            'nbrCommandes' => $nbrCommandes,
            'nbrAlertes' => $nbrAlertes,
            'nbrActivites' => $nbrActivites,
        ]);
    }
    public function commandesInternes()
    {
        // Récupère toutes les commandes internes (ex: toutes les commandes où id_depot_principale = 1)
        $commandes = \App\Models\CommandeDepotSc::where('id_depot_principale', 1)
            ->orderBy('date_cmd', 'desc')
            ->paginate(10);

        return view('chef.Commande_Interne.index', compact('commandes'));
    }
    public function showCommandeInterne($id)
    {
        $commande = \App\Models\CommandeDepotSc::with(['depotSource', 'details'])->findOrFail($id);
        return view('chef.Commande_Interne.show', compact('commande'));
    }
    public function livrerCommandeInterne(Request $request, $id)
    {
        $commande = \App\Models\CommandeDepotSc::with('details')->findOrFail($id);

        foreach ($commande->details as $detail) {
            $qteLivree = $request->quantite_livree[$detail->id_detail_cmd_depot_sc] ?? 0;

            // Récupère la ligne de stock du produit
            $stock = StockProduit::where('id_produit', $detail->id_produit)->first();

            if ($stock && $stock->quantite >= $qteLivree) {
                $stock->quantite -= $qteLivree;
                $stock->save();
            }
        }

        $commande->statut = 'livrée';
        $commande->save();

        return redirect()->route('commande_interne.index')->with('success', 'Livraison effectuée et stock mis à jour !');
    }
}
