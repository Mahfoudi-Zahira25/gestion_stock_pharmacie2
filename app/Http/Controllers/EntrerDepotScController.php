<?php

namespace App\Http\Controllers;

use App\Models\EntrerDepotSc;
use App\Models\Depot;
use App\Models\Produit;
use Illuminate\Http\Request;

class EntrerDepotScController extends Controller
{
    public function index()
    {
        $entrees = EntrerDepotSc::all();
        return view('entrer_depot_scs.index', compact('entrees'));
    }

    public function create()
    {
        $depots = Depot::all();
        $produits = Produit::all();
        return view('majeur.stock_entrer', compact('depots', 'produits'));
    }

    public function store(Request $request)
    {
        EntrerDepotSc::create($request->all());
        return redirect()->route('entrer_depot_scs.index');
    }

    public function show(EntrerDepotSc $entrerDepotSc)
    {
        return view('entrer_depot_scs.show', compact('entrerDepotSc'));
    }

    public function edit(EntrerDepotSc $entrerDepotSc)
    {
        return view('entrer_depot_scs.edit', compact('entrerDepotSc'));
    }

    public function update(Request $request, EntrerDepotSc $entrerDepotSc)
    {
        $entrerDepotSc->update($request->all());
        return redirect()->route('entrer_depot_scs.index');
    }

    public function destroy(EntrerDepotSc $entrerDepotSc)
    {
        $entrerDepotSc->delete();
        return redirect()->route('entrer_depot_scs.index');
    }
    public function historique()
    {
        $entrees = \App\Models\EntrerDepotSc::orderBy('created_at', 'desc')->get();
        return view('majeur.historique_entrees', compact('entrees'));
    }
}
