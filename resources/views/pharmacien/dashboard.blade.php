
@extends('layouts.app')

@section('content')
    <h2>Bienvenue Responsable Pharmacie</h2>

    <table class="table">
        <thead>
            <tr>
                <th>ID Produit</th>
                <th>Nom</th>
                <th>Quantité Initiale</th>
                <th>Stock Alerte</th>
                <th>Stock Sécurité</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($produits as $produit)
                <tr>
                    <td>{{ $produit->id }}</td>
                    <td>{{ $produit->nom }}</td>
                    <td>{{ $produit->quantite_initiale }}</td>
                    <td>{{ $produit->stock_alerte }}</td>
                    <td>{{ $produit->stock_securite }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
