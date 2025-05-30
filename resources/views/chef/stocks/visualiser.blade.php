@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="mb-0 text-primary">Visualisation du stock</h3>
        <span class="badge bg-primary fs-6">Total produits : {{ $stocks->count() }}</span>
    </div>
    <div class="card shadow border-0">
        <div class="card-body bg-light">
            <table class="table table-striped align-middle">
                <thead class="table-primary">
                    <tr>
                        <th>Nom du produit</th>
                        <th>Quantité en stock</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($stocks as $stock)
                        <tr>
                            <td>{{ $stock->nom_produit }}</td>
                            <td>{{ $stock->quantite }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" class="text-center text-muted">Aucun stock trouvé.</td>
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