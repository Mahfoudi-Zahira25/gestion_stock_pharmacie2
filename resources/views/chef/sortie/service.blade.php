@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Sortie vers Service</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('sortie.enregistrer') }}" method="POST">
                        @csrf

                        <!-- Informations générales -->
                        <div class="row mb-4">
                            <div class="col-md-4 mb-3">
                                <label for="date_cmd" class="form-label fw-semibold">Date de commande</label>
                                <input type="date" name="date_cmd" id="date_cmd" class="form-control" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="date_sortie" class="form-label fw-semibold">Date de livraison</label>
                                <input type="date" name="date_sortie" id="date_sortie" class="form-control" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="type_commande" class="form-label fw-semibold">Type de commande</label>
                                <select name="type_commande" id="type_commande" class="form-select" required>
                                    <option value="">Sélectionner</option>
                                    @foreach($types_commande as $type)
                                        <option value="{{ $type }}">{{ $type }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Dépôts -->
                        <div class="row mb-4">
                            <!-- Dépôt source (caché, toujours principal) -->
                            <input type="hidden" name="id_depot_source" value="1"> <!-- Remplace 1 par l'id réel du dépôt principal -->

                            <div class="col-md-6 mb-3">
                                <label for="id_depot_destin" class="form-label fw-semibold">Dépôt destination</label>
                                <select name="id_depot_destin" id="id_depot_destin" class="form-select" required>
                                    <option value="">Sélectionner</option>
                                    @foreach($services as $depot)
                                        <option value="{{ $depot->id_depot }}">{{ $depot->nom }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Liste des produits -->
                        <h5 class="mb-3 mt-4 fw-bold text-primary">Liste des produits</h5>
                        <div class="table-responsive mb-4">
                            <table class="table table-bordered table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>Produit</th>
                                        <th style="width: 200px;">Quantité livrée</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($produits as $produit)
                                    <tr>
                                        <td>{{ $produit->nom }}</td>
                                        <td>
                                            <input type="number" name="quantite_sortie[{{ $produit->id }}]" min="0" class="form-control" value="0">
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <button type="submit" class="btn btn-success px-4">
                                <i class="bi bi-save"></i> Enregistrer la sortie
                            </button>
                            @if(session('last_sortie_id'))
                                <a href="{{ route('sortie.bonLivraison', session('last_sortie_id')) }}" class="btn btn-primary px-4">
                                    <i class="bi bi-file-earmark-text"></i> Voir le bon
                                </a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection