@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-center mb-4">Bon de Commande</h2>

    <div class="mb-3">
        <strong>Numéro de commande :</strong> CMD-{{ $commande->id }}<br>
        <strong>Fournisseur :</strong> {{ $commande->fournisseur->nom }}<br>
        <strong>Date :</strong> {{ \Carbon\Carbon::parse($commande->date_commande)->format('d/m/Y') }}<br>
        <strong>Dépôt :</strong> {{ $commande->id_depot }}
    </div>

    <table class="table table-bordered">
        <thead class="table-secondary">
            <tr>
                <th>#</th>
                <th>Produit</th>
                <th>Type</th>
                <th>Quantité demandée</th>
            </tr>
        </thead>
        <tbody>
            @foreach($commande->produits as $index => $produit)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $produit->nom }}</td>
                <td>{{ $produit->type }}</td>
                <td>{{ $produit->pivot->quantite }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        <a href="{{ route('commande_fournisseurs.create') }}" class="btn btn-primary">Nouvelle commande</a>
<a href="{{ route('commande.pdf', $commande->id) }}" target="_blank" class="btn btn-success">Imprimer</a>
    </div>
</div>
@endsection
