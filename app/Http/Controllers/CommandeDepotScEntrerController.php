<?php

namespace App\Http\Controllers;

use App\Models\CommandeDepotScEntrer;
use Illuminate\Http\Request;

class CommandeDepotScEntrerController extends Controller
{
    public function index()
    {
        $liens = CommandeDepotScEntrer::all();
        return view('commande_depot_sc_entrer.index', compact('liens'));
    }

    public function create()
    {
        return view('commande_depot_sc_entrer.create');
    }

    public function store(Request $request)
    {
        CommandeDepotScEntrer::create($request->all());
        return redirect()->route('commande_depot_sc_entrer.index');
    }

    public function show(CommandeDepotScEntrer $commandeDepotScEntrer)
    {
        return view('commande_depot_sc_entrer.show', compact('commandeDepotScEntrer'));
    }

    public function edit(CommandeDepotScEntrer $commandeDepotScEntrer)
    {
        return view('commande_depot_sc_entrer.edit', compact('commandeDepotScEntrer'));
    }

    public function update(Request $request, CommandeDepotScEntrer $commandeDepotScEntrer)
    {
        $commandeDepotScEntrer->update($request->all());
        return redirect()->route('commande_depot_sc_entrer.index');
    }

    public function destroy(CommandeDepotScEntrer $commandeDepotScEntrer)
    {
        $commandeDepotScEntrer->delete();
        return redirect()->route('commande_depot_sc_entrer.index');
    }
}
