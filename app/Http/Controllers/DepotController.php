<?php

namespace App\Http\Controllers;
use App\Models\Depot;
use App\Models\Produit;
use Illuminate\Http\Request;

class DepotController extends Controller
{
    public function index() {
        $depots = Depot::all();
        return view('depots.index', compact('depots'));
    }

    public function create() {
        return view('depots.create');
    }

    public function store(Request $request) {
        $request->validate([
            'nom' => 'required|string|max:255',
            'type' => 'required|in:principal,secondaire',
        ]);

        Depot::create($request->all());
        return redirect()->route('depots.index')->with('success', 'Dépôt ajouté avec succès.');
    }

    public function show($id) {
        $depot = Depot::findOrFail($id);
        return view('depots.show', compact('depot'));
    }

    public function edit($id) {
        $depot = Depot::findOrFail($id);
        return view('depots.edit', compact('depot'));
    }

    public function update(Request $request, $id) {
        $request->validate([
            'nom' => 'required|string|max:255',
            'type' => 'required|in:principal,secondaire',
        ]);

        $depot = Depot::findOrFail($id);
        $depot->update($request->all());
        return redirect()->route('depots.index')->with('success', 'Dépôt mis à jour avec succès.');
    }

    public function destroy($id) {
        Depot::destroy($id);
        return redirect()->route('depots.index')->with('success', 'Dépôt supprimé avec succès.');
    }
     public function dashboard()
    {
        $produits = Produit::all(); // ou un service plus intelligent
        return view('pharmacie.dashboard', compact('produits'));
    }
}