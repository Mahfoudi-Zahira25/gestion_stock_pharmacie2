<?php
namespace App\Http\Controllers;

use App\Models\SortieVersPatient;
use App\Models\Patient;
use App\Models\Depot;
use Illuminate\Http\Request;

class SortieVersPatientController extends Controller
{
    public function index()
    {
        $sorties = SortieVersPatient::with('patient', 'depot')->get();
        return view('sortie_vers_patients.index', compact('sorties'));
    }

    public function create()
    {
        $patients = Patient::all();
        $depots = Depot::all();
        return view('sortie_vers_patients.create', compact('patients', 'depots'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_patient' => 'required|exists:patients,id_patient',
            'date_sortie' => 'required|date',
            'id_depot' => 'required|exists:depots,id_depot',
        ]);
        SortieVersPatient::create($request->all());
        return redirect()->route('sortie_vers_patients.index')->with('success', 'Sortie vers patient enregistrée.');
    }

    public function show(SortieVersPatient $sortieVersPatient)
    {
        return view('sortie_vers_patients.show', compact('sortieVersPatient'));
    }

    public function edit(SortieVersPatient $sortieVersPatient)
    {
        $patients = Patient::all();
        $depots = Depot::all();
        return view('sortie_vers_patients.edit', compact('sortieVersPatient', 'patients', 'depots'));
    }

    public function update(Request $request, SortieVersPatient $sortieVersPatient)
    {
        $request->validate([
            'id_patient' => 'required|exists:patients,id_patient',
            'date_sortie' => 'required|date',
            'id_depot' => 'required|exists:depots,id_depot',
        ]);
        $sortieVersPatient->update($request->all());
        return redirect()->route('sortie_vers_patients.index')->with('success', 'Sortie vers patient mise à jour.');
    }

    public function destroy(SortieVersPatient $sortieVersPatient)
    {
        $sortieVersPatient->delete();
        return redirect()->route('sortie_vers_patients.index')->with('success', 'Sortie vers patient supprimée.');
    }
}
