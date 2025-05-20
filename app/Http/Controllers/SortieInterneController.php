<?php
namespace App\Http\Controllers;

use App\Models\SortieInterne;
use App\Models\Depot;
use Illuminate\Http\Request;

class SortieInterneController extends Controller
{
    public function index()
    {
        $sorties = SortieInterne::with('depot')->get();
        return view('sortie_internes.index', compact('sorties'));
    }

    public function create()
    {
        $depots = Depot::all();
        return view('sortie_internes.create', compact('depots'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_depot' => 'required|exists:depots,id_depot',
            'date_sortie' => 'required|date',
            'destinataire_type' => 'required|string|max:255',
            'destinataire_nom' => 'required|string|max:255',
        ]);
        SortieInterne::create($request->all());
        return redirect()->route('sortie_internes.index')->with('success', 'Sortie interne créée.');
    }

    public function show(SortieInterne $sortieInterne)
    {
        return view('sortie_internes.show', compact('sortieInterne'));
    }

    public function edit(SortieInterne $sortieInterne)
    {
        $depots = Depot::all();
        return view('sortie_internes.edit', compact('sortieInterne', 'depots'));
    }

    public function update(Request $request, SortieInterne $sortieInterne)
    {
        $request->validate([
            'id_depot' => 'required|exists:depots,id_depot',
            'date_sortie' => 'required|date',
            'destinataire_type' => 'required|string|max:255',
            'destinataire_nom' => 'required|string|max:255',
        ]);
        $sortieInterne->update($request->all());
        return redirect()->route('sortie_internes.index')->with('success', 'Sortie interne mise à jour.');
    }

    public function destroy(SortieInterne $sortieInterne)
    {
        $sortieInterne->delete();
        return redirect()->route('sortie_internes.index')->with('success', 'Sortie interne supprimée.');
    }
}
