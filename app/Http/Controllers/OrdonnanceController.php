<?php

namespace App\Http\Controllers;

use App\Models\Ordonnance;
use App\Models\Patient;
use App\Models\Medecin;
use App\Models\Produit;
use Illuminate\Http\Request;

class OrdonnanceController extends Controller
{
    // Afficher la liste des ordonnances
    public function index()
    {
        $ordonnances = Ordonnance::all(); // Récupérer toutes les ordonnances
        return view('ordonnances.index', compact('ordonnances'));
    }

    // Afficher le formulaire pour créer une nouvelle ordonnance
    public function create()
    {
        // $patients = Patient::all(); // Récupérer tous les patients
        // $medecins = Medecin::all(); // Récupérer tous les médecins
        $produits = Produit::all(); // Récupérer tous les produits (médicaments, dispositifs médicaux, etc.)
        return view('ordonnances.create', compact('patients', 'medecins', 'produits'));
    }

    // Enregistrer une nouvelle ordonnance
    public function store(Request $request)
    {
        // Validation des données reçues
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'medecin_id' => 'required|exists:medecins,id',
            'produits' => 'required|array',
            'quantites' => 'required|array',
            'date_ordonnance' => 'required|date',
        ]);

        // Création de l'ordonnance
        $ordonnance = Ordonnance::create([
            'patient_id' => $request->patient_id,
            'medecin_id' => $request->medecin_id,
            'date_ordonnance' => $request->date_ordonnance,
        ]);

        // Enregistrement des produits et quantités associés à l'ordonnance
        foreach ($request->produits as $key => $produitId) {
            $quantite = $request->quantites[$key];

            // Enregistrer le détail de l'ordonnance
            $ordonnance->produits()->attach($produitId, ['quantite' => $quantite]);
        }

        return redirect()->route('ordonnances.index')->with('success', 'Ordonnance créée avec succès.');
    }

    // Afficher les détails d'une ordonnance
    public function show($id)
    {
        $ordonnance = Ordonnance::findOrFail($id); // Trouver l'ordonnance par son ID
        $produits = $ordonnance->produits; // Récupérer les produits associés à l'ordonnance
        return view('ordonnances.show', compact('ordonnance', 'produits'));
    }

    // Afficher le formulaire d'édition d'une ordonnance
    public function edit($id)
    {
        $ordonnance = Ordonnance::findOrFail($id); // Trouver l'ordonnance par son ID
        // $patients = Patient::all(); // Récupérer tous les patients
        // $medecins = Medecin::all(); // Récupérer tous les médecins
        $produits = Produit::all(); // Récupérer tous les produits disponibles
        return view('ordonnances.edit', compact('ordonnance', 'patients', 'medecins', 'produits'));
    }

    // Mettre à jour une ordonnance existante
    public function update(Request $request, $id)
    {
        // Validation des données reçues
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'medecin_id' => 'required|exists:medecins,id',
            'produits' => 'required|array',
            'quantites' => 'required|array',
            'date_ordonnance' => 'required|date',
        ]);

        // Récupérer l'ordonnance existante
        $ordonnance = Ordonnance::findOrFail($id);
        $ordonnance->update([
            'patient_id' => $request->patient_id,
            'medecin_id' => $request->medecin_id,
            'date_ordonnance' => $request->date_ordonnance,
        ]);

        // Supprimer les anciens produits associés et ajouter les nouveaux
        $ordonnance->produits()->detach();

        // Ajouter les nouveaux produits à l'ordonnance
        foreach ($request->produits as $key => $produitId) {
            $quantite = $request->quantites[$key];

            // Ajouter les produits au détail de l'ordonnance
            $ordonnance->produits()->attach($produitId, ['quantite' => $quantite]);
        }

        return redirect()->route('ordonnances.index')->with('success', 'Ordonnance mise à jour avec succès.');
    }

    // Supprimer une ordonnance
    public function destroy($id)
    {
        $ordonnance = Ordonnance::findOrFail($id);

        // Supprimer les produits associés
        $ordonnance->produits()->detach();

        // Supprimer l'ordonnance
        $ordonnance->delete();

        return redirect()->route('ordonnances.index')->with('success', 'Ordonnance supprimée avec succès.');
    }
}
