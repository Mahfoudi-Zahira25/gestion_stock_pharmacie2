<?php

namespace App\Http\Controllers;

use App\Models\DetailEntrerDepotSc;
use Illuminate\Http\Request;

class DetailEntrerDepotScController extends Controller
{
    public function index()
    {
        $details = DetailEntrerDepotSc::all();
        return view('detail_entrer_depot_scs.index', compact('details'));
    }

    public function create()
    {
        return view('detail_entrer_depot_scs.create');
    }

    public function store(Request $request)
    {
        DetailEntrerDepotSc::create($request->all());
        return redirect()->route('detail_entrer_depot_scs.index');
    }

    public function show(DetailEntrerDepotSc $detailEntrerDepotSc)
    {
        return view('detail_entrer_depot_scs.show', compact('detailEntrerDepotSc'));
    }

    public function edit(DetailEntrerDepotSc $detailEntrerDepotSc)
    {
        return view('detail_entrer_depot_scs.edit', compact('detailEntrerDepotSc'));
    }

    public function update(Request $request, DetailEntrerDepotSc $detailEntrerDepotSc)
    {
        $detailEntrerDepotSc->update($request->all());
        return redirect()->route('detail_entrer_depot_scs.index');
    }

    public function destroy(DetailEntrerDepotSc $detailEntrerDepotSc)
    {
        $detailEntrerDepotSc->delete();
        return redirect()->route('detail_entrer_depot_scs.index');
    }
}
