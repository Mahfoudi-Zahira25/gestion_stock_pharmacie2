<?php

namespace App\Http\Controllers;

use App\Models\EntreeFournisseur;
use App\Models\Depot;
use App\Models\Fournisseur;
use Illuminate\Http\Request;

class EntreeController extends Controller {
    public function index() {
        $entrees = EntreeFournisseur::with(['depot', 'fournisseur'])->get();
        return view('entrees.index', compact('entrees'));
    }

    public function create() {
        $depots = Depot::all();
        $fournisseurs = Fournisseur::all();
        return view('entrees.create', compact('depots', 'fournisseurs'));
    }

    public function store(Request $request) {
        $request->validate([
            'id_depot' => 'required|exists:depots,id',
            'id_fournisseur' => 'required|exists:fournisseurs,id',
            'date_entree' => 'required|date',
        ]);

        EntreeFournisseur::create($request->all());
        return redirect()->route('entrees.index')->with('success', 'Entrée enregistrée avec succès.');
    }

    public function show($id) {
        $entree = EntreeFournisseur::with(['depot', 'fournisseur'])->findOrFail($id);
        return view('entrees.show', compact('entree'));
    }

    public function edit($id) {
        $entree = EntreeFournisseur::findOrFail($id);
        $depots = Depot::all();
        $fournisseurs = Fournisseur::all();
        return view('entrees.edit', compact('entree', 'depots', 'fournisseurs'));
    }

    public function update(Request $request, $id) {
        $request->validate([
            'id_depot' => 'required|exists:depots,id',
            'id_fournisseur' => 'required|exists:fournisseurs,id',
            'date_entree' => 'required|date',
        ]);

        $entree = EntreeFournisseur::findOrFail($id);
        $entree->update($request->all());
        return redirect()->route('entrees.index')->with('success', 'Entrée mise à jour avec succès.');
    }

    public function destroy($id) {
        EntreeFournisseur::destroy($id);
        return redirect()->route('entrees.index')->with('success', 'Entrée supprimée avec succès.');
    }
}
