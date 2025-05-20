<?php

namespace App\Http\Controllers;

use App\Models\DetailCommandeDepotSc;
use Illuminate\Http\Request;

class DetailCommandeDepotScController extends Controller
{
    public function index()
    {
        $details = DetailCommandeDepotSc::all();
        return view('detail_commande_depot_scs.index', compact('details'));
    }

    public function create()
    {
        return view('detail_commande_depot_scs.create');
    }

    public function store(Request $request)
    {
        DetailCommandeDepotSc::create($request->all());
        return redirect()->route('detail_commande_depot_scs.index');
    }

    public function show(DetailCommandeDepotSc $detailCommandeDepotSc)
    {
        return view('detail_commande_depot_scs.show', compact('detailCommandeDepotSc'));
    }

    public function edit(DetailCommandeDepotSc $detailCommandeDepotSc)
    {
        return view('detail_commande_depot_scs.edit', compact('detailCommandeDepotSc'));
    }

    public function update(Request $request, DetailCommandeDepotSc $detailCommandeDepotSc)
    {
        $detailCommandeDepotSc->update($request->all());
        return redirect()->route('detail_commande_depot_scs.index');
    }

    public function destroy(DetailCommandeDepotSc $detailCommandeDepotSc)
    {
        $detailCommandeDepotSc->delete();
        return redirect()->route('detail_commande_depot_scs.index');
    }
}
