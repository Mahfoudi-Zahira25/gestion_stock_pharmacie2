<?php
namespace App\Http\Controllers;

use App\Models\DetailSortiePatient;
use App\Models\SortieVersPatient;
use App\Models\Produit;
use Illuminate\Http\Request;

class DetailSortiePatientController extends Controller
{
    public function index()
    {
        $details = DetailSortiePatient::with('sortieVersPatient', 'produit')->get();
        return view('detail_sortie_patients.index', compact('details'));
    }

    public function create()
    {
        $sorties = SortieVersPatient::all();
        $produits = Produit::all();
        return view('detail_sortie_patients.create', compact('sorties', 'produits'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_sortie_vers_patient' => 'required|exists:sortie_vers_patients,id',
            'id_produit' => 'required|exists:produits,id',
            'quantite' => 'required|integer|min:1',
        ]);
        DetailSortiePatient::create($request->all());
        return redirect()->route('detail_sortie_patients.index')->with('success', 'Détail sortie patient ajouté.');
    }

    public function show(DetailSortiePatient $detailSortiePatient)
    {
        return view('detail_sortie_patients.show', compact('detailSortiePatient'));
    }

    public function edit(DetailSortiePatient $detailSortiePatient)
    {
        $sorties = SortieVersPatient::all();
        $produits = Produit::all();
        return view('detail_sortie_patients.edit', compact('detailSortiePatient', 'sorties', 'produits'));
    }

    public function update(Request $request, DetailSortiePatient $detailSortiePatient)
    {
        $request->validate([
            'id_sortie_vers_patient' => 'required|exists:sortie_vers_patients,id',
            'id_produit' => 'required|exists:produits,id',
            'quantite' => 'required|integer|min:1',
        ]);
        $detailSortiePatient->update($request->all());
        return redirect()->route('detail_sortie_patients.index')->with('success', 'Détail sortie patient mis à jour.');
    }

    public function destroy(DetailSortiePatient $detailSortiePatient)
    {
        $detailSortiePatient->delete();
        return redirect()->route('detail_sortie_patients.index')->with('success', 'Détail sortie patient supprimé.');
    }
}
