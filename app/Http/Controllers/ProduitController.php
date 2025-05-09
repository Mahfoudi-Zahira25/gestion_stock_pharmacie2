<?php

namespace App\Http\Controllers;
use App\Models\Produit;
use Illuminate\Http\Request;

class ProduitController extends Controller
{
    public function index() {
        $produits = Produit::all();
        return view('produits.index', compact('produits'));
    }

    public function create() {
        return view('produits.create');
    }

    public function store(Request $request) {
        $request->validate([
            'nom' => 'required|string|max:255',
            'type' => 'required|string|max:100',
            'unite' => 'required|string|max:50',
            'stock_initial' => 'nullable|integer|min:0',
        ]);

        Produit::create($request->all());
        return redirect()->route('produits.index')->with('success', 'Produit ajouté avec succès.');
    }

    public function show($id) {
        $produit = Produit::findOrFail($id);
        return view('produits.show', compact('produit'));
    }

    public function edit($id) {
        $produit = Produit::findOrFail($id);
        return view('produits.edit', compact('produit'));
    }

    public function update(Request $request, $id) {
        $request->validate([
            'nom' => 'required|string|max:255',
            'type' => 'required|string|max:100',
            'unite' => 'required|string|max:50',
            'stock_initial' => 'nullable|integer|min:0',
        ]);

        $produit = Produit::findOrFail($id);
        $produit->update($request->all());
        return redirect()->route('produits.index')->with('success', 'Produit mis à jour avec succès.');
    }

    public function destroy($id) {
        Produit::destroy($id);
        return redirect()->route('produits.index')->with('success', 'Produit supprimé avec succès.');
    }
}
