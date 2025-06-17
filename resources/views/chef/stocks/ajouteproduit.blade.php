@extends('layouts.app')

@section('title', 'Ajouter un produit')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="card shadow border-0">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0"><i class="bi bi-plus-circle"></i> Ajouter un produit</h4>
                </div>
                <div class="card-body bg-light">
                    <form action="{{ route('produits.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="nom" class="form-label">Nom du produit</label>
                            <input type="text" name="nom" id="nom" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="prix" class="form-label">Prix</label>
                            <input type="number" name="prix" id="prix" class="form-control" step="0.01" min="0" required>
                        </div>
                        <div class="mb-3">
                            <label for="type" class="form-label">Type</label>
                            <input type="text" name="type" id="type" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="forme" class="form-label">Forme</label>
                            <input type="text" name="forme" id="forme" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="unite" class="form-label">Unité</label>
                            <input type="text" name="unite" id="unite" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="quantite" class="form-label">Quantité initiale</label>
                            <input type="number" name="quantite" id="quantite" class="form-control" min="0" required>
                        </div>
                        <div class="mb-3">
                            <label for="stock_alerte" class="form-label">Stock d'alerte</label>
                            <input type="number" name="stock_alerte" id="stock_alerte" class="form-control" min="0" required>
                        </div>
                        <div class="mb-3">
                            <label for="stock_securite" class="form-label">Stock de sécurité</label>
                            <input type="number" name="stock_securite" id="stock_securite" class="form-control" min="0" required>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-success px-4">
                                <i class="bi bi-check-circle"></i> Enregistrer
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection