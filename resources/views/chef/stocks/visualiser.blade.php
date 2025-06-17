@extends('layouts.app')

@section('content')
<div class="container py-4">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="mb-0 text-primary">Visualisation du stock</h3>
        <span class="badge bg-primary fs-6">Total produits : {{ $stocks->count() }}</span>
        <a href="{{ route('produits.create') }}" class="btn btn-success">
            <i class="bi bi-plus-circle"></i> Ajouter un produit
        </a>
    </div>
    <div class="card shadow border-0">
        <div class="card-body bg-light">
            <table class="table table-striped align-middle">
                <thead class="table-primary">
                    <tr>
                        <th>Nom du produit</th>
                        <th>Quantité en stock</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($stocks as $stock)
                        <tr>
                            <td>{{ $stock->nom_produit ?? '' }}</td>
                            <td>{{ $stock->quantite ?? 0 }}</td>
                            <td class="text-center">
                                <a href="{{ route('produits.edit', $stock->id_produit ?? $stock->id ?? '') }}" class="btn btn-sm btn-primary">
                                    <i class="bi bi-pencil"></i> Modifier
                                </a>
                                {{-- Bouton Supprimer retiré --}}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center text-muted">Aucun produit trouvé.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
@endpush