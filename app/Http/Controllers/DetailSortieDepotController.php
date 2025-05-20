<?php

namespace App\Http\Controllers;

use App\Models\DetailSortieDepot;
use Illuminate\Http\Request;

class DetailSortieDepotController extends Controller
{
    public function index()
    {
        $details = DetailSortieDepot::with('sortieDepot', 'produit')->get();
        return view('detail_sortie_depots.index', compact('details'));
    }

    public function create()
    {
        return view('detail_sortie_depots.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_sortie_depot' => 'required|exists:sortie_depots,id_sortie_depot',
            'id_produit' => 'required|exists:produits,id',
            'quantite' => 'required|integer|min:1',
        ]);

        DetailSortieDepot::create($request->all());

        return redirect()->route('detail_sortie_depots.index')->with('success', 'Détail sortie dépôt créé avec succès.');
    }

    public function show(DetailSortieDepot $detailSortieDepot)
    {
        return view('detail_sortie_depots.show', compact('detailSortieDepot'));
    }

    public function edit(DetailSortieDepot $detailSortieDepot)
    {
        return view('detail_sortie_depots.edit', compact('detailSortieDepot'));
    }

    public function update(Request $request, DetailSortieDepot $detailSortieDepot)
    {
        $request->validate([
            'id_sortie_depot' => 'required|exists:sortie_depots,id_sortie_depot',
            'id_produit' => 'required|exists:produits,id',
            'quantite' => 'required|integer|min:1',
        ]);

        $detailSortieDepot->update($request->all());

        return redirect()->route('detail_sortie_depots.index')->with('success', 'Détail sortie dépôt mis à jour avec succès.');
    }

    public function destroy(DetailSortieDepot $detailSortieDepot)
    {
        $detailSortieDepot->delete();

        return redirect()->route('detail_sortie_depots.index')->with('success', 'Détail sortie dépôt supprimé avec succès.');
    }
}
