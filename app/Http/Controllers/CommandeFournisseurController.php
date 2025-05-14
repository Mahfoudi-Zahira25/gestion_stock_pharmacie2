<?php

namespace App\Http\Controllers;

use App\Models\CommandeFournisseur;
    use App\Models\Depot;
    use App\Models\Fournisseur;
    use App\Models\Commande;
    use Illuminate\Http\Request;
use App\Models\Produit;
use Barryvdh\DomPDF\Facade\Pdf;

    class CommandeFournisseurController extends Controller {
    public function index()
        {
        return view('chef.commandes_fournisseur.index');
       }

       public function create()
{
    $fournisseurs = Fournisseur::all();
    $produits = Produit::all(); // tous les médicaments et dispositifs médicaux
        return view('chef.commandes_fournisseur.create', compact('fournisseurs', 'produits'));
    }


        

public function store(Request $request)
{
    $request->validate([
        'id_fournisseur' => 'required|exists:fournisseurs,id',
        'date_commande' => 'required|date',
        'quantites' => 'required|array',
    ]);

    // Vérifier que le dépôt avec id = 1 existe
    $depot = Depot::find(1);
    if (!$depot) {
        return back()->withErrors(['msg' => 'Le dépôt avec id = 1 n\'existe pas.']);
    }

    // Forcer id_depot = 1 pour la commande fournisseur
    $commande = CommandeFournisseur::create([
        'id_fournisseur' => $request->id_fournisseur,
        'id_depot' => 1, // Forcé ici, si le dépôt existe
        'date_commande' => $request->date_commande,
        'statut' => 'en attente',
    ]);

    // Attacher les produits à la commande avec les quantités
    foreach ($request->quantites as $produit_id => $quantite) {
    if ($quantite > 0) {
        // Attacher les produits à la commande avec la quantité
        $commande->produits()->attach($produit_id, ['quantite' => $quantite]);
    }
}


    return redirect()->route('commande_fournisseurs.bon_commande', $commande->id);
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
    
    

public function exportPDF($id)
{
    $commande = CommandeFournisseur::with(['fournisseur', 'produits'])->findOrFail($id);
    
    $pdf = Pdf::loadView('commandes_fournisseur.pdf', compact('commande'));

    return $pdf->stream('bon_commande_'.$commande->id.'.pdf');
}

    }