@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg rounded">
        <div class="card-header bg-info text-white">
            <h4>Détails de la Livraison N°{{ $entree->id }}</h4>
        </div>

        <div class="card-body">
            <p><strong>📅 Date de réception :</strong> {{ \Carbon\Carbon::parse($entree->date_entree)->format('d/m/Y') }}</p>
            <p><strong>🏥 Fournisseur :</strong> {{ $entree->fournisseur->nom ?? 'Non spécifié' }}</p>

            <table class="table table-striped mt-4">
                <thead class="table-light">
                    <tr>
                        <th>Produit</th>
                        <th>Quantité Reçue</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($entree->details as $detail)
                    <tr>
                        <td>{{ $detail->produit->nom }}</td>
                        <td>{{ $detail->quantite_recue }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <a href="{{ route('entrees.index') }}" class="btn btn-secondary mt-3">⬅️ Retour à la liste</a>
        </div>
    </div>
</div>
@endsection
