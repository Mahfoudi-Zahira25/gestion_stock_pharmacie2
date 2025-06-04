{{-- filepath: resources/views/chef/Commande_Interne/show.blade.php --}}
@extends('layouts.app')

@section('title', 'Détail de la commande')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-body">
                    <h2 class="mb-4 text-primary">
                        <i class="bi bi-receipt"></i> Détail de la commande
                    </h2>
                    <div class="mb-3">
                        <span class="fw-bold">Date :</span>
                        <span class="badge bg-light text-dark">{{ \Carbon\Carbon::parse($commande->date_cmd)->format('d/m/Y') }}</span>
                    </div>
                    <div class="mb-3">
                        <span class="fw-bold">Service demandeur :</span>
                        <span class="badge bg-info text-dark">{{ $commande->depotSource->nom ?? '-' }}</span>
                    </div>
                    <div class="mb-3">
                        <span class="fw-bold">Statut :</span>
                        @if($commande->statut === 'livrée')
                            <span class="badge bg-success"><i class="bi bi-check-circle"></i> Livrée</span>
                        @else
                            <span class="badge bg-warning text-dark"><i class="bi bi-hourglass-split"></i> En attente</span>
                        @endif
                    </div>

                    <h5 class="mt-4 mb-3">Produits commandés</h5>
                    <form action="{{ route('chef.commande_interne.livrer', $commande->id_cmd_sc) }}" method="POST">
                        @csrf
                        <div class="table-responsive">
                            <table class="table table-bordered align-middle">
                                <thead class="table-primary">
                                    <tr>
                                        <th>Produit</th>
                                        <th>Quantité demandée</th>
                                        <th>Quantité à livrer</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($commande->details as $i => $detail)
                                    <tr>
                                        <td>{{ $detail->produit->nom ?? '' }}</td>
                                        <td>
                                            <span class="badge bg-light text-dark">{{ $detail->quantite_cmd }}</span>
                                        </td>
                                        <td>
                                            <input type="number"
                                                name="quantite_livree[{{ $detail->id_detail_cmd_depot_sc }}]"
                                                value="{{ $detail->quantite_cmd }}"
                                                min="0"
                                                max="{{ $detail->quantite_cmd }}"
                                                class="form-control"
                                                required
                                                @if($commande->statut === 'livrée') disabled @endif
                                            >
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        @if($commande->statut !== 'livrée')
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-gradient-primary px-4">
                                    <i class="bi bi-truck"></i> Faire la livraison
                                </button>
                            </div>
                        @else
                            <div class="alert alert-success mt-3 mb-0">
                                Cette commande a déjà été livrée.
                            </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Style personnalisé --}}
<style>
    .btn-gradient-primary {
        background: linear-gradient(90deg, #0d6efd 0%, #6ea8fe 100%);
        color: #fff;
        border: none;
    }
    .btn-gradient-primary:hover {
        background: linear-gradient(90deg, #0b5ed7 0%, #5c9cf5 100%);
        color: #fff;
    }
    .card {
        border-radius: 1rem;
    }
    .table-primary th {
        background: linear-gradient(90deg, #0d6efd 0%, #6ea8fe 100%) !important;
        color: #fff !important;
    }
</style>
@endsection