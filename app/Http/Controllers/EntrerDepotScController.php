<?php

namespace App\Http\Controllers;

use App\Models\EntrerDepotSc;
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
        return view('entrer_depot_scs.create');
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
}
