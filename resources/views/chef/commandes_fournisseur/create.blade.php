@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Passer une commande fournisseur</h2>

    <form action="{{ route('commande_fournisseurs.store') }}" method="POST">
        @csrf

        <!-- Sélection du fournisseur -->
        <div class="form-group">
            <label for="id_fournisseur">Fournisseur</label>
            <select name="id_fournisseur" class="form-control" required>
                <option value="">-- Choisir un fournisseur --</option>
                @foreach ($fournisseurs as $fournisseur)
                    <option value="{{ $fournisseur->id }}">{{ $fournisseur->nom }}</option>
                @endforeach
            </select>
        </div>

        <!-- Champ caché pour le dépôt (ID = 1) -->
        <input type="hidden" name="id_depot" value="1">

        <!-- Affichage du nom du dépôt (pour info uniquement) -->
        <div class="form-group">
            <label>Dépôt concerné</label>
            <input type="text" class="form-control" value="Dépôt Principal" disabled>
        </div>

        <!-- Date de la commande -->
        <div class="form-group">
            <label for="date_commande">Date de la commande</label>
            <input type="date" name="date_commande" class="form-control" value="{{ date('Y-m-d') }}" required>
        </div>

        <hr>

        <!-- Tableau des produits à commander -->
        <h4>Produits à commander</h4>
        <table class="table">
            <thead>
                <tr>
                    <th>Nom du produit</th>
                    <th>Quantité</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($produits as $produit)
                    <tr>
                        <td>{{ $produit->nom }}</td>
                        <td>
                            <input type="number" name="quantites[{{ $produit->id }}]" class="form-control" min="0" value="0">
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <button type="submit" class="btn btn-primary">Valider la commande</button>
        <a href="{{ route('commande_fournisseurs.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection

