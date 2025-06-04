@extends('layouts.app')

@section('title', 'Commandes internes reçues')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0 text-primary">
            <i class="bi bi-clipboard-data"></i> Commandes internes reçues
        </h2>
        {{-- <a href="#" class="btn btn-outline-primary">Exporter</a> --}}
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow" role="alert">
            <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card border-0 shadow-lg rounded-4">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-primary">
                        <tr>
                            <th>Date</th>
                            <th>Service demandeur</th>
                            <th>Type</th>
                            <th>Statut</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($commandes as $commande)
                            <tr>
                                <td>
                                    <span class="fw-semibold text-primary">
                                        {{ \Carbon\Carbon::parse($commande->date_cmd)->format('d/m/Y') }}
                                    </span>
                                </td>
                                <td>
                                    <span class="fw-semibold text-dark">
                                        <i class="bi bi-building"></i> {{ $commande->depotSource->nom ?? '-' }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge bg-info text-dark px-3 py-2">
                                        {{ ucfirst($commande->type_commande) }}
                                    </span>
                                </td>
                                <td>
                                    @if($commande->statut === 'livrée')
                                        <span class="badge bg-success px-3 py-2">
                                            <i class="bi bi-check-circle"></i> Livrée
                                        </span>
                                    @else
                                        <span class="badge bg-warning text-dark px-3 py-2">
                                            <i class="bi bi-hourglass-split"></i> En attente
                                        </span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if($commande->statut !== 'livrée')
                                        <a href="{{ route('chef.commande_interne.show', $commande->id_cmd_sc) }}" class="btn btn-sm btn-gradient-primary">
                                            <i class="bi bi-eye"></i> Voir
                                        </a>
                                    @else
                                        <button class="btn btn-sm btn-outline-secondary" disabled>
                                            <i class="bi bi-check2-all"></i> Déjà livrée
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">Aucune commande interne trouvée.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="mt-3">
        {{ $commandes->links() }}
    </div>
</div>

{{-- Style personnalisé pour un effet professionnel --}}
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
    .table thead th {
        border-top-left-radius: 0.5rem;
        border-top-right-radius: 0.5rem;
    }
</style>
@endsection