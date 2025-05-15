@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="text-center mb-4">Commandes Fournisseur</h2>

    <div class="d-flex justify-content-end mb-4">
       <a href="{{ route('commandes_fournisseur.create') }}" class="btn btn-primary me-2">Passer une commande</a>
       <a href="{{ route('livraisons.create') }}" class="btn btn-success">Enregistrer une livraison</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($commandes->isEmpty())
        <div class="alert alert-info text-center">
            Aucune commande enregistrée pour le moment.
        </div>
    @else
        <table class="table table-bordered table-hover">
            <thead class="table-light">
                <tr>
                    <th>#ID</th>
                    <th>Fournisseur</th>
                    <th>Date de commande</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($commandes as $commande)
                    <tr>
                        <td>{{ $commande->id }}</td>
                        <td>{{ $commande->fournisseur->nom }}</td>
                        <td>{{ \Carbon\Carbon::parse($commande->date_commande)->format('d/m/Y') }}</td>
                        <td>{{ ucfirst($commande->statut) }}</td>
                        <td>
                            <a href="{{ route('commande_fournisseurs.show', $commande->id) }}" class="btn btn-sm btn-info">Voir</a>
                            <!-- Ajoute ici d'autres boutons si besoin -->
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
