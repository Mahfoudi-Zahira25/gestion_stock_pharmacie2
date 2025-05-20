<?php

namespace App\Http\Controllers;

use App\Models\AlerteStock;
use App\Models\Depot;
use App\Models\Produit;
use Illuminate\Http\Request;

class AlerteStockController extends Controller
{
    public function index()
    {
        $alertes = AlerteStock::with('depot', 'produit')->paginate(20);
        return view('alerteStocks.index', compact('alertes'));
    }

    public function create()
    {
        $depots = Depot::all();
        $produits = Produit::all();
        return view('alerteStocks.create', compact('depots', 'produits'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_depot' => 'required|exists:depots,id_depot',
            'id_produit' => 'required|exists:produits,id',
            'type_alerte' => 'required|string|max:255',
            'date_alerte' => 'required|date',
        ]);

        AlerteStock::create($validated);

        return redirect()->route('alerteStocks.index')->with('success', 'Alerte créée avec succès.');
    }

    public function show(AlerteStock $alerteStock)
    {
        $alerteStock->load('depot', 'produit');
        return view('alerteStocks.show', compact('alerteStock'));
    }

    public function edit(AlerteStock $alerteStock)
    {
        $depots = Depot::all();
        $produits = Produit::all();
        return view('alerteStocks.edit', compact('alerteStock', 'depots', 'produits'));
    }

    public function update(Request $request, AlerteStock $alerteStock)
    {
        $validated = $request->validate([
            'id_depot' => 'required|exists:depots,id_depot',
            'id_produit' => 'required|exists:produits,id',
            'type_alerte' => 'required|string|max:255',
            'date_alerte' => 'required|date',
        ]);

        $alerteStock->update($validated);

        return redirect()->route('alerteStocks.index')->with('success', 'Alerte mise à jour avec succès.');
    }

    public function destroy(AlerteStock $alerteStock)
    {
        $alerteStock->delete();
        return redirect()->route('alerteStocks.index')->with('success', 'Alerte supprimée avec succès.');
    }
}
