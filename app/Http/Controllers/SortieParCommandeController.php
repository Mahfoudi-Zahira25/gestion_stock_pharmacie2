<?php

namespace App\Http\Controllers;

use App\Models\SortieParCommande;
use Illuminate\Http\Request;

class SortieParCommandeController extends Controller
{
    public function index()
    {
        $sorties = SortieParCommande::with('commandeDepot', 'sortieDepot')->get();
        return view('sortie_par_commandes.index', compact('sorties'));
    }

    public function create()
    {
        return view('sortie_par_commandes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_cmd_depot' => 'required|exists:cmd_depot,id',
            'id_sortie_depot' => 'required|exists:sortie_depots,id_sortie_depot',
        ]);

        SortieParCommande::create($request->all());

        return redirect()->route('sortie_par_commandes.index')->with('success', 'Sortie par commande créée avec succès.');
    }

    public function show(SortieParCommande $sortieParCommande)
    {
        return view('sortie_par_commandes.show', compact('sortieParCommande'));
    }

    public function edit(SortieParCommande $sortieParCommande)
    {
        return view('sortie_par_commandes.edit', compact('sortieParCommande'));
    }

    public function update(Request $request, SortieParCommande $sortieParCommande)
    {
        $request->validate([
            'id_cmd_depot' => 'required|exists:cmd_depot,id',
            'id_sortie_depot' => 'required|exists:sortie_depots,id_sortie_depot',
        ]);

        $sortieParCommande->update($request->all());

        return redirect()->route('sortie_par_commandes.index')->with('success', 'Sortie par commande mise à jour avec succès.');
    }

    public function destroy(SortieParCommande $sortieParCommande)
    {
        $sortieParCommande->delete();

        return redirect()->route('sortie_par_commandes.index')->with('success', 'Sortie par commande supprimée avec succès.');
    }
}
