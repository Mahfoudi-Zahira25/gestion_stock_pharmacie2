@extends('layouts.app') {{-- adapte si ton layout a un autre nom --}}

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg rounded">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0"> Enregistrement Livraison - Commande N°{{ $commande->id }}</h4>
        </div>

        <div class="card-body">
            <p><strong> Fournisseur :</strong> {{ $commande->fournisseur->nom }}</p>
            <p><strong> Date de commande :</strong> {{ \Carbon\Carbon::parse($commande->date_commande)->format('d/m/Y') }}</p>
            
            <form method="POST" action="{{ route('entrees.store') }}">
                @csrf
                <input type="hidden" name="commande_id" value="{{ $commande->id }}">

                {{-- ✅ CHAMP DE DATE AVEC NOM CORRECT --}}
                <div class="form-group mb-4">
                    <label for="date_entree" class="form-label"><strong>📥 Date de réception :</strong></label>
                    <input type="date" name="date_entree" class="form-control" required>
                </div>

                <table class="table table-bordered table-hover align-middle text-center">
                    <thead class="table-light">
                        <tr>
                            <th> Produit</th>
                            <th> Quantité Commandée</th>
                            <th> Quantité Reçue</th>
                            <th> Quantité Restante</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($commande->detailsCommande as $index => $detail)
                        <tr>
                            <td>{{ $detail->produit->nom }}</td>
                            <td>
                                <input type="number" class="form-control" value="{{ $detail->quantite }}" readonly>
                            </td>
                            <td>
                                <input type="number" class="form-control quantite-recue" name="quantite_recue[]" min="0" max="{{ $detail->quantite }}" data-index="{{ $index }}" data-qte-total="{{ $detail->quantite }}" required>
                                <input type="hidden" name="produit_id[]" value="{{ $detail->produit->id }}">
                            </td>
                            <td>
                                <input type="number" class="form-control quantite-restante" value="{{ $detail->quantite }}" readonly id="restante-{{ $index }}">
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="text-end mt-4">
                    <button type="submit" class="btn btn-success">
                        Enregistrer la livraison
                    </button>
                </div>

                @if(session('success'))
                    <div class="mt-3 alert alert-success fw-bold">
                        {{ session('success') }}
                    </div>
                @endif

            </form>
        </div>
    </div>
</div>

{{-- Script JS pour le calcul automatique de la quantité restante --}}
<script>
    document.querySelectorAll('.quantite-recue').forEach(input => {
        input.addEventListener('input', function() {
            const index = this.dataset.index;
            const qteTotale = parseInt(this.dataset.qteTotal);
            const qteRecue = parseInt(this.value) || 0;
            const restanteField = document.getElementById('restante-' + index);
            restanteField.value = qteTotale - qteRecue;
        });
    });
</script>
@endsection