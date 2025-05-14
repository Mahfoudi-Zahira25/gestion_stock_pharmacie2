@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="text-center mb-4">Commandes Fournisseur</h2>

    <div class="d-flex justify-content-end mb-4">
       <a href="{{ route('commande_fournisseurs.create') }}" class="btn btn-primary me-2">Passer une commande</a>

        <a href="{{ route('livraisons.create') }}" class="btn btn-success">Enregistrer une livraison</a>
    </div>

    <!-- Tu peux afficher ici une liste des commandes ou autre -->
    <div class="alert alert-info text-center">
        Sélectionnez une action ci-dessus pour continuer.
    </div>
</div>
@endsection
