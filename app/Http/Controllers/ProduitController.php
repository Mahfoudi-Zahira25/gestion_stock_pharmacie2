<?php

namespace App\Http\Controllers;
use App\Models\Produit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProduitController extends Controller
{
    public function index() {
        $produits = Produit::all();
        return view('produits.index', compact('produits'));
    }

    public function create() {
        return view('chef.stocks.ajouteproduit');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prix' => 'required|numeric|min:0',
            'type' => 'required|string|max:100',
            'forme' => 'required|string|max:100',
            'unite' => 'required|string|max:50',
            'quantite' => 'required|integer|min:0',
            'stock_alerte' => 'required|integer|min:0',
            'stock_securite' => 'required|integer|min:0',
        ]);

        $produit = \App\Models\Produit::create([
            'nom' => $request->nom,
            'prix' => $request->prix,
            'type' => $request->type,
            'forme' => $request->forme,
            'unite' => $request->unite,
        ]);

        \App\Models\StockProduit::create([
            'id_produit' => $produit->id, // ou $produit->id_produit selon ta table
            'quantite' => $request->quantite,
            'stock_alerte' => $request->stock_alerte,
            'stock_securite' => $request->stock_securite,
        ]);

        return redirect()->route('visualiserstock')->with('success', 'Produit ajouté avec succès !');
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

    public function visualiserStock() {
        $stocks = DB::table('stock_produits')
            ->join('produits', 'stock_produits.id_produit', '=', 'produits.id')
            ->select('stock_produits.*', 'produits.nom as nom_produit')
            ->get();

        return view('chef.stocks.visualiser', compact('stocks'));
    }
}

