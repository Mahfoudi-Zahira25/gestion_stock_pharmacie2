@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="text-center mb-4">Modifier le Fournisseur</h2>

    <form method="POST" action="{{ route('fournisseurs.update', $fournisseur->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" class="form-control" id="nom" name="nom" value="{{ old('nom', $fournisseur->nom) }}" required>
        </div>

        <div class="mb-3">
            <label for="type" class="form-label">Type</label>
            <input type="text" class="form-control" id="type" name="type" value="{{ old('type', $fournisseur->type) }}" required>
        </div>

        <div class="mb-3">
            <label for="adresse" class="form-label">Adresse</label>
            <input type="text" class="form-control" id="adresse" name="adresse" value="{{ old('adresse', $fournisseur->adresse) }}" required>
        </div>

        <div class="mb-3">
            <label for="telephone" class="form-label">Téléphone</label>
            <input type="text" class="form-control" id="telephone" name="telephone" value="{{ old('telephone', $fournisseur->telephone) }}" required>
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ route('fournisseurs.index') }}" class="btn btn-secondary">Annuler</a>
            <button type="submit" class="btn btn-primary">Modifier</button>
        </div>
    </form>
</div>
@endsection
