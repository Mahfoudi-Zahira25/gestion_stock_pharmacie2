@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Nouvelle commande </h2>

    <form action="{{ route('commande_fournisseurs.store') }}" method="POST" id="formCommande">
        @csrf
        <input type="hidden" name="id_fournisseur" value="{{ $fournisseur_id }}">
        <input type="hidden" name="date_commande" value="{{ $date_commande }}">

        <div class="row mb-3">
            <div class="col-md-6">
                <label>Produit</label>
                <select class="form-control" id="produitSelect">
                    <option value="">-- Choisir --</option>
                    @foreach ($produits as $produit)
                        <option value="{{ $produit->id }}" data-nom="{{ $produit->nom }}">{{ $produit->nom }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label>Quantité</label>
                <input type="number" id="quantiteInput" class="form-control" min="1">
            </div>
            <div class="col-md-2 d-flex align-items-end">
                <button type="button" class="btn btn-success" onclick="ajouterProduit()">Ajouter</button>
            </div>
        </div>

        <table class="table table-bordered" id="tableProduits">
            <thead>
                <tr>
                    <th>Produit</th>
                    <th>Quantité</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <!-- Produits ajoutés -->
            </tbody>
        </table>

        <button type="submit" class="btn btn-primary">Valider la commande</button>
    </form>
</div>

<script>
    function ajouterProduit() {
        let select = document.getElementById('produitSelect');
        let quantite = document.getElementById('quantiteInput').value;
        let produitId = select.value;
        let produitNom = select.options[select.selectedIndex].dataset.nom;

        if (!produitId || !quantite || quantite <= 0) {
            alert("Veuillez choisir un produit et une quantité valide.");
            return;
        }

        let table = document.querySelector('#tableProduits tbody');
        let ligne = document.createElement('tr');

        ligne.innerHTML = `
            <td>${produitNom}</td>
            <td>${quantite}</td>
            <td><button type="button" class="btn btn-danger btn-sm" onclick="this.closest('tr').remove()">Supprimer</button></td>
            <input type="hidden" name="quantites[${produitId}]" value="${quantite}">
        `;

        table.appendChild(ligne);
        document.getElementById('quantiteInput').value = '';
        select.selectedIndex = 0;
    }
</script>

@endsection
