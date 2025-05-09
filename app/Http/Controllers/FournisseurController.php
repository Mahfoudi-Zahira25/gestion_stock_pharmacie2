<?php

namespace App\Http\Controllers;
use App\Models\Fournisseur;
use Illuminate\Http\Request;

class FournisseurController extends Controller
{public function index() {
    $fournisseurs = Fournisseur::all();
    return view('fournisseurs.index', compact('fournisseurs'));
}

public function create() {
    return view('fournisseurs.create');
}

public function store(Request $request) {
    $request->validate([
        'nom' => 'required|string|max:255',
        'adresse' => 'nullable|string|max:255',
        'telephone' => 'nullable|string|max:20',
        'email' => 'nullable|email|max:255',
    ]);

    Fournisseur::create($request->all());
    return redirect()->route('fournisseurs.index')->with('success', 'Fournisseur ajouté avec succès.');
}

public function show($id) {
    $fournisseur = Fournisseur::findOrFail($id);
    return view('fournisseurs.show', compact('fournisseur'));
}

public function edit($id) {
    $fournisseur = Fournisseur::findOrFail($id);
    return view('fournisseurs.edit', compact('fournisseur'));
}

public function update(Request $request, $id) {
    $request->validate([
        'nom' => 'required|string|max:255',
        'adresse' => 'nullable|string|max:255',
        'telephone' => 'nullable|string|max:20',
        'email' => 'nullable|email|max:255',
    ]);

    $fournisseur = Fournisseur::findOrFail($id);
    $fournisseur->update($request->all());
    return redirect()->route('fournisseurs.index')->with('success', 'Fournisseur mis à jour avec succès.');
}

public function destroy($id) {
    Fournisseur::destroy($id);
    return redirect()->route('fournisseurs.index')->with('success', 'Fournisseur supprimé avec succès.');
}
}
