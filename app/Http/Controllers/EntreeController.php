<?php

namespace App\Http\Controllers;

use App\Models\CommandeFournisseur;
use App\Models\EntreeFournisseur;
use App\Models\Depot;
use App\Models\DetailEntree;
use App\Models\Fournisseur;
use App\Models\StockProduit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EntreeController extends Controller
{
    public function index()
    {
        $entrees = EntreeFournisseur::with(['depot', 'fournisseur'])->get();
        return view('entrees.index', compact('entrees'));
    }




    public function store(Request $request)
    {
        $request->validate([
            'commande_id' => 'required|exists:commande_fournisseurs,id',
            'date_entree' => 'required|date',
            'produit_id' => 'required|array',
            'quantite_recue' => 'required|array',
        ]);

        try {
            DB::beginTransaction();

            $commande = CommandeFournisseur::findOrFail($request->commande_id);

            $entree = EntreeFournisseur::create([
                'commande_id' => $commande->id,
                'date_entree' => $request->date_entree,
                'id_depot' => 1, // ou $commande->id_depot si tu l’as
                'fournisseur_id' => $commande->fournisseur_id,
            ]);

            // dd($entree);

            foreach ($request->produit_id as $i => $produitId) {
                DetailEntree::create([
                    'id_entree' => $entree->id_entree,
                    'id_produit' => $produitId,
                    'quantite_recue' => $request->quantite_recue[$i],
                ]);
            }

            DB::commit();
            return back()->with('success', 'Livraison enregistrée avec succès.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', "Erreur lors de l'enregistrement : " . $e->getMessage());
        }
    }




    //     public function create($commande_id)
    // {
    //     $commande = CommandeFournisseur::findOrFail($commande_id);

    //     // On suppose que la pharmacie hospitalière est le dépôt principal
    //     $depotPrincipal = Depot::where('type', 'principal')->first();

    //     return view('chef.commandes_fournisseur.enregistrer_livraison', [
    //         'commande' => $commande,
    //         'depot_id' => $depotPrincipal->id
    //     ]);
    // }

    // // ...existing code...


    // public function store(Request $request)
    // {
    //     // ✅ Validation des données
    //     $request->validate([
    //         'commande_id' => 'required|exists:commande_fournisseurs,id',
    //         'date_entree' => 'required|date',
    //         'produit_id' => 'required|array',
    //         'quantite_recue' => 'required|array',
    //     ]);

    //     // ✅ Création de l'entree (livraison)
    //     $entree = EntreeFournisseur::create([
    //         'commande_id' => $request->commande_id,
    //         'date_entree' => $request->date_entree,
    //         'id_depot' => 1, // adapte cette valeur selon ta logique (ex: id du dépôt principal)
    //         'fournisseur_id' => \App\Models\CommandeFournisseur::find($request->commande_id)->fournisseur_id,
    //     ]);

    //     // ✅ Enregistrement des détails
    //     foreach ($request->produit_id as $index => $produitId) {
    //         DetailEntree::create([
    //             'id_entree' => $entree->id_entree,
    //             'id_produit' => $produitId,
    //             'quantite_recue' => $request->quantite_recue[$index],
    //         ]);
    //     }

    //     return redirect()->back()->with('success', 'Livraison enregistrée avec succès.');
    // }










    // public function show($id) {
    //     $entree = EntreeFournisseur::with(['depot', 'fournisseur'])->findOrFail($id);
    //     return view('entrees.show', compact('entree'));}
    public function show($id)
    {
        $entree = EntreeFournisseur::with('details.produit')->findOrFail($id);

        return view('chef.entrees.show', compact('entree'));
    }



    public function edit($id)
    {
        $entree = EntreeFournisseur::findOrFail($id);
        $depots = Depot::all();
        $fournisseurs = Fournisseur::all();
        return view('entrees.edit', compact('entree', 'depots', 'fournisseurs'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_depot' => 'required|exists:depots,id',
            'fournisseur_id' => 'required|exists:fournisseurs,id',
            'date_entree' => 'required|date',
        ]);

        $entree = EntreeFournisseur::findOrFail($id);
        $entree->update($request->all());
        return redirect()->route('entrees.index')->with('success', 'Entrée mise à jour avec succès.');
    }

    public function destroy($id)
    {
        EntreeFournisseur::destroy($id);
        return redirect()->route('entrees.index')->with('success', 'Entrée supprimée avec succès.');
    }



    // 


    // public function sauvegarder(Request $request)
    // {
    //    $request->validate([
    //         'commande_id' => 'required|exists:commande_fournisseurs,id',
    //         'date_reception' => 'required|date',
    //         'produit_id' => 'required|array',
    //         'quantite_recue' => 'required|array',
    //     ]);

    //     try {
    //         DB::beginTransaction();

    //         // Créer l'entrée
    //         $entree = EntreeFournisseur::create([
    //             'commande_id'    => $request->commande_id,
    //             'date_entree'    => $request->date_reception,
    //             'id_depot'       => 1, // à adapter selon ton projet
    //             'fournisseur_id' => \App\Models\CommandeFournisseur::find($request->commande_id)->id_fournisseur,
    //         ]);

    //         // Enregistrer les détails
    //         foreach ($request->produit_id as $index => $idProduit) {
    //             $quantite = $request->quantite_recue[$index];

    //             // DetailEntree::create([
    //             //     'id_entree'      => $entree->id,
    //             //     'id_produit'     => $idProduit,
    //             //     'quantite_recue' => $quantite,
    //             // ]);
    //             DetailEntree::create([
    // 'id_entree' => $entree->id,
    //     'id_produit'     => $idProduit,
    //     'quantite_recue' => $quantite, // sans accent, exactement comme dans ta table
    // ]);

    //         }

    //         DB::commit();
    //         return redirect()->route('entrees.index')->with('success', 'Livraison enregistrée avec succès.');

    //     } catch (\Exception $e) {
    //         DB::rollBack();
    //         return back()->with('error', 'Erreur lors de l\'enregistrement : ' . $e->getMessage());
    //     }
    // }



}
