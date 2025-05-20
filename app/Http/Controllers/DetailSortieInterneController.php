<?php
namespace App\Http\Controllers;

use App\Models\DetailSortieInterne;
use App\Models\SortieInterne;
use App\Models\Produit;
use Illuminate\Http\Request;

class DetailSortieInterneController extends Controller
{
    public function index()
    {
        $details = DetailSortieInterne::with('sortieInterne', 'produit')->get();
        return view('detail_sortie_internes.index', compact('details'));
    }

    public function create()
    {
        $sorties = SortieInterne::all();
        $produits = Produit::all();
        return view('detail_sortie_internes.create', compact('sorties', 'produits'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_sortie_interne' => 'required|exists:sortie_internes,id_sortie_interne',
            'id_produit' => 'required|exists:produits,id',
            'quantite' => 'required|integer|min:1',
        ]);
        DetailSortieInterne::create($request->all());
        return redirect()->route('detail_sortie_internes.index')->with('success', 'Détail sortie interne ajouté.');
    }

    public function show(DetailSortieInterne $detailSortieInterne)
    {
        return view('detail_sortie_internes.show', compact('detailSortieInterne'));
    }

    public function edit(DetailSortieInterne $detailSortieInterne)
    {
        $sorties = SortieInterne::all();
        $produits = Produit::all();
        return view('detail_sortie_internes.edit', compact('detailSortieInterne', 'sorties', 'produits'));
    }

    public function update(Request $request, DetailSortieInterne $detailSortieInterne)
    {
        $request->validate([
            'id_sortie_interne' => 'required|exists:sortie_internes,id_sortie_interne',
            'id_produit' => 'required|exists:produits,id',
            'quantite' => 'required|integer|min:1',
        ]);
        $detailSortieInterne->update($request->all());
        return redirect()->route('detail_sortie_internes.index')->with('success', 'Détail sortie interne mis à jour.');
    }

    public function destroy(DetailSortieInterne $detailSortieInterne)
    {
        $detailSortieInterne->delete();
        return redirect()->route('detail_sortie_internes.index')->with('success', 'Détail sortie interne supprimé.');
    }
}
