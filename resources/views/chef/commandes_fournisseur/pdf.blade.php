<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Bon de Commande CMD-{{ $commande->id }}</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 13px;
            color: #000;
        }
        h2 {
            text-align: center;
            margin-bottom: 30px;
        }
        .infos {
            margin-bottom: 20px;
        }
        .infos strong {
            display: inline-block;
            width: 160px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        th, td {
            border: 1px solid #444;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #e4e4e4;
        }
        .signature {
            margin-top: 50px;
            text-align: right;
        }
    </style>
</head>
<body>

    <h2>Bon de Commande</h2>

    <div class="infos">
        <p><strong>Numéro de commande :</strong> CMD-{{ $commande->id }}</p>
        <p><strong>Fournisseur :</strong> {{ $commande->fournisseur->nom }}</p>
        <p><strong>Date de commande :</strong> {{ \Carbon\Carbon::parse($commande->date_commande)->format('d/m/Y') }}</p>
        <p><strong>Dépôt :</strong> {{ $commande->id_depot }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Produit</th>
                <th>Type</th>
                <th>Quantité demandée</th>
            </tr>
        </thead>
        <tbody>
            @foreach($commande->produits as $index => $produit)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $produit->nom }}</td>
                <td>{{ $produit->type }}</td>
                <td>{{ $produit->pivot->quantite }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="signature">
        <p><strong>Chef de la pharmacie</strong></p>
        <p>Signature :</p>
    </div>

</body>
</html>
