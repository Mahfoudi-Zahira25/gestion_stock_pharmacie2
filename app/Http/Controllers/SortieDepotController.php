<?php

namespace App\Http\Controllers;

use App\Models\SortieDepot;
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
        return view('sortie_depots.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'date_sortie' => 'required|date',
            'id_depot_source' => 'required|exists:depots,id_depot',
            'id_depot_destin' => 'required|exists:depots,id_depot',
        ]);

        SortieDepot::create($request->all());

        return redirect()->route('sortie_depots.index')->with('success', 'Sortie dépôt créée avec succès.');
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
}
