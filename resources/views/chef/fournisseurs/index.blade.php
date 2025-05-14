@extends('layouts.app')

@section('content')
<div class="container py-4">
    <!-- Titre centré -->
    <h2 class="text-center mb-4">Gestion fournisseur</h2>

    <!-- Bouton Ajouter/Créer en haut à droite -->
    <div class="mb-4 d-flex justify-content-end">
        <a href="{{ route('fournisseurs.create') }}" class="btn btn-success">Ajouter Fournisseur</a>
    </div>

    <!-- Tableau des fournisseurs -->
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nom Fournisseur</th>
                    <th>Type</th>
                    <th>Adresse</th>x
                    <th>Téléphone</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($fournisseurs as $fournisseur)
                    <tr>
                        <td>{{ $fournisseur->nom }}</td>
                        <td>{{ $fournisseur->type }}</td>
                        <td>{{ $fournisseur->adresse }}</td>
                        <td>{{ $fournisseur->telephone }}</td>
                        <td>
                            <!-- Bouton Modifier -->
                            <a href="{{ route('fournisseurs.edit', $fournisseur->id) }}" class="btn btn-warning btn-sm">Modifier</a>

                            <!-- Formulaire pour supprimer -->
                            <form action="{{ route('fournisseurs.destroy', $fournisseur->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

