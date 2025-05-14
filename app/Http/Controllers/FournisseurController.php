<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fournisseur;

class FournisseurController extends Controller
{
        public function index()
    {
        $fournisseurs = Fournisseur::all();
        return view('chef.fournisseurs.index', compact('fournisseurs'));
    }
    public function create()
{
    return view('chef.fournisseurs.create');
}




    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required',
            'type' => 'required',
            'adresse' => 'required',
            'telephone' => 'required',
        ]);

        Fournisseur::create($request->all());
        return redirect()->route('fournisseurs.index');
    }

    public function edit($id)
    {
        $fournisseur = Fournisseur::findOrFail($id);
        return view('chef.fournisseurs.edit', compact('fournisseur'));
    }

    public function update(Request $request, $id)
    {
        $fournisseur = Fournisseur::findOrFail($id);
        $fournisseur->update($request->all());
        return redirect()->route('fournisseurs.index');
    }

    public function destroy($id)
    {
        Fournisseur::destroy($id);
        return redirect()->route('fournisseurs.index');
    }
}
