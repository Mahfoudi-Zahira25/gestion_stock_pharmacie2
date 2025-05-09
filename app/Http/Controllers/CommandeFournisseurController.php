<?php

namespace App\Http\Controllers;

use App\Models\CommandeFournisseur;
    use App\Models\Depot;
    use App\Models\Fournisseur;
    use Illuminate\Http\Request;
    
    class CommandeFournisseurController extends Controller {
        public function index() {
            $commandes = CommandeFournisseur::with(['depot', 'fournisseur'])->get();
            return view('commandes.index', compact('commandes'));
        }

        public function create() {
            $depots = Depot::all();
            $fournisseurs = Fournisseur::all();
            return view('commandes.create', compact('depots', 'fournisseurs'));
        }

        public function store(Request $request) {
            $request->validate([
                'id_depot' => 'required|exists:depots,id',
                'id_fournisseur' => 'required|exists:fournisseurs,id',
                'date_commande' => 'required|date',
                'statut' => 'required|string',
            ]);

            CommandeFournisseur::create($request->all());
            return redirect()->route('commandes.index')->with('success', 'Commande fournisseur créée avec succès.');
        }

        public function show($id) {
            $commande = CommandeFournisseur::with(['depot', 'fournisseur'])->findOrFail($id);
            return view('commandes.show', compact('commande'));
        }

        public function edit($id) {
            $commande = CommandeFournisseur::findOrFail($id);
            $depots = Depot::all();
            $fournisseurs = Fournisseur::all();
            return view('commandes.edit', compact('commande', 'depots', 'fournisseurs'));
        }

        public function update(Request $request, $id) {
            $request->validate([
                'id_depot' => 'required|exists:depots,id',
                'id_fournisseur' => 'required|exists:fournisseurs,id',
                'date_commande' => 'required|date',
                'statut' => 'required|string',
            ]);

            $commande = CommandeFournisseur::findOrFail($id);
            $commande->update($request->all());
            return redirect()->route('commandes.index')->with('success', 'Commande mise à jour avec succès.');
        }

        public function destroy($id) {
            CommandeFournisseur::destroy($id);
            return redirect()->route('commandes.index')->with('success', 'Commande supprimée avec succès.');
        }
    }
