<?php

namespace App\Http\Controllers;

use App\Models\CommandeFournisseur;
    use App\Models\Depot;
    use App\Models\Fournisseur;
    use App\Models\Commande;
use App\Models\DetailCommande;
use Illuminate\Http\Request;
use App\Models\Produit;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

    class CommandeFournisseurController extends Controller {
    public function index()
        {
        // return view('chef.commandes_fournisseur.index');
    

    $commandes = CommandeFournisseur::with('fournisseur')->orderBy('created_at', 'desc')->get();
    return view('chef.commandes_fournisseur.index', compact('commandes'));
}

       
public function step1() {
    $fournisseurs = Fournisseur::all();
    return view('chef.commandes_fournisseur.create', compact('fournisseurs'));
}

public function step2(Request $request) {
    $request->validate([
        'id_fournisseur' => 'required|exists:fournisseurs,id',
        'date_commande' => 'required|date',
    ]);

    $fournisseur_id = $request->id_fournisseur;
    $date_commande = $request->date_commande;
    $produits = Produit::all();

    return view('chef.commandes_fournisseur.produits', compact('fournisseur_id', 'date_commande', 'produits'));
}


//        public function create()
// {
//     $fournisseurs = Fournisseur::all();
//     $produits = Produit::all(); // tous les médicaments et dispositifs médicaux
//         return view('chef.commandes_fournisseur.create', compact('fournisseurs', 'produits'));
//     }


        public function create()
{
    $fournisseurs = Fournisseur::all();
    return view('chef.commandes_fournisseur.create', compact('fournisseurs'));
}



public function produits($id)
{
    $commande = CommandeFournisseur::findOrFail($id);
    $produits = Produit::all();
    return view('chef.commandes_fournisseur.produits', compact('commande', 'produits'));
}

public function storeProduits(Request $request)
{
    $commande = CommandeFournisseur::findOrFail($request->commande_id);
    $produits = json_decode($request->produits_json, true);

    foreach ($produits as $prod) {
        DetailCommande::create([
            'commande_fournisseur_id' => $commande->id,
            'produit_id' => $prod['id'],
            'quantite' => $prod['quantite'],
        ]);
    }

    return redirect()->route('commandes_fournisseur.index')->with('success', 'Commande enregistrée avec succès.');
}
// Dans CommandeFournisseurController.php
public function store(Request $request)
{
    $request->validate([
        'id_fournisseur' => 'required|exists:fournisseurs,id',
        'date_commande' => 'required|date',
        'quantites' => 'required|array',
    ]);

    // Étape 1 : Créer la commande
    $commande = CommandeFournisseur::create([
        'id_fournisseur' => $request->id_fournisseur,
        'date_commande' => $request->date_commande,
        'id_depot' => 1, // à adapter si besoin
        'statut' => 'en attente', // par défaut
    ]);

    // Étape 2 : Insérer les détails de la commande
    foreach ($request->quantites as $id_produit => $quantite) {
        if ($quantite > 0) {
            DB::table('detail_commandes')->insert([
                'commande_id' => $commande->id,
                'produit_id' => $id_produit,
                'quantite' => $quantite,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    return redirect()->route('commandes_fournisseur.index')->with('success', 'Commande enregistrée avec succès');
}





       public function bonCommande($id)
{
    $commande = CommandeFournisseur::with(['fournisseur', 'produits'])->findOrFail($id);
    return view('chef.commandes_fournisseur.bon_commande', compact('commande'));

}

        public function show($id) {
            $commande = CommandeFournisseur::with(['depot', 'fournisseur'])->findOrFail($id);
            return view('commandes.show', compact('commande'));
        }

        public function edit($id) {
            $commande = CommandeFournisseur::findOrFail($id);
            $depots = Depot::all();
            $fournisseurs = Fournisseur::all();
            return view('commandes.edit', compact('commande', 'depots', 'fournisseurs'));
        }

        public function update(Request $request, $id) {
            $request->validate([
                'id_depot' => 'required|exists:depots,id',
                'id_fournisseur' => 'required|exists:fournisseurs,id',
                'date_commande' => 'required|date',
                'statut' => 'required|string',
            ]);

            $commande = CommandeFournisseur::findOrFail($id);
            $commande->update($request->all());
            return redirect()->route('commandes.index')->with('success', 'Commande mise à jour avec succès.');
        }

        public function destroy($id) {
            CommandeFournisseur::destroy($id);
            return redirect()->route('commandes.index')->with('success', 'Commande supprimée avec succès.');
        }
    
    


public function afficherProduits()
{
    $produits = Produit::all(); // Récupère tous les produits
    return view('chef.commandes_fournisseur.produits', compact('produits'));
}

    }