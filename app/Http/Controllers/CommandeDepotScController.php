<?php

namespace App\Http\Controllers;

use App\Models\CommandeDepotSc;
use Illuminate\Http\Request;

class CommandeDepotScController extends Controller
{
    public function index()
    {
        $commandes = CommandeDepotSc::all();
        return view('commande_depot_scs.index', compact('commandes'));
    }

    public function create()
    {
        return view('commande_depot_scs.create');
    }

    public function store(Request $request)
    {
        CommandeDepotSc::create($request->all());
        return redirect()->route('commande_depot_scs.index');
    }

    public function show(CommandeDepotSc $commandeDepotSc)
    {
        return view('commande_depot_scs.show', compact('commandeDepotSc'));
    }

    public function edit(CommandeDepotSc $commandeDepotSc)
    {
        return view('commande_depot_scs.edit', compact('commandeDepotSc'));
    }

    public function update(Request $request, CommandeDepotSc $commandeDepotSc)
    {
        $commandeDepotSc->update($request->all());
        return redirect()->route('commande_depot_scs.index');
    }

    public function destroy(CommandeDepotSc $commandeDepotSc)
    {
        $commandeDepotSc->delete();
        return redirect()->route('commande_depot_scs.index');
    }
}
