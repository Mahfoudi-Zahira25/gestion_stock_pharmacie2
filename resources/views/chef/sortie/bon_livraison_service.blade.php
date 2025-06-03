@extends('layouts.app')

@section('content')
<style>
@media print {
    body * {
        visibility: hidden !important;
    }
    #print-bon, #print-bon * {
        visibility: visible !important;
    }
    #print-bon {
        position: fixed !important;
        left: 2; top: 0; width: 10000px; height: 10000px;
        margin: 0 !important;
        padding: 0 !important;
        border-radius: 0 !important;
        box-shadow: none !important;
        background: #fff !important;
    }
    .btn, .btn-outline-primary, .mb-3.text-end {
        display: none !important;
    }
    @page {
        margin: 0;
        size: A5 portrait;
    }
}
</style>

<div class="mb-3 text-end">
    <button onclick="window.print()" class="btn btn-outline-primary">
        <i class="bi bi-printer"></i> Imprimer le bon
    </button>
</div>

<div id="print-bon" class="container py-4" style="background: #fff; border-radius: 10px; box-shadow: 0 2px 8px #e0e0e0; font-family: 'Segoe UI', sans-serif;">

    <!-- En-tête institutionnelle avec logo centré -->
    <div class="d-flex justify-content-between align-items-center mb-4" style="position: relative;">
        <!-- Infos FR -->
        <div style="width: 33%; font-size: 0.95rem; line-height: 1.5;">
            <strong>ROYAUME DU MAROC</strong><br>
            Ministère de la Santé<br>
            Délégation Provinciale de Settat<br>
            Hôpital Hassan II de Settat
        </div>

        <!-- Logo centré -->
        <div style="position: absolute; left: 50%; transform: translateX(-50%);">
            <img src="{{ asset('images/th.jpeg') }}" alt="Logo" style="height: 80px;">
        </div>

        <!-- Infos AR -->
        <div class="text-end" style="width: 33%; font-size: 0.95rem; line-height: 1.5; direction: rtl;">
            <strong>المملكة المغربية</strong><br>
            وزارة الصحة<br>
            المندوبية الإقليمية بسطات<br>
            مستشفى الحسن الثاني بسطات
        </div>
    </div>

    <!-- Titre du bon de livraison -->
    <div class="text-center mb-4">
        <h4 class="mb-1 text-primary" style="letter-spacing:1px;">Bon de Livraison Service</h4>
        <div class="text-muted">N° {{ $sortie->id_sortie_depot ?? $sortie->id }}</div>
    </div>

    <!-- Informations générales -->
    <div class="row mb-2">
        <div class="col-md-6">
            <strong>Service destinataire :</strong> {{ $sortie->service->nom ?? '-' }}
        </div>
        <div class="col-md-6 text-md-end">
            <strong>Date de sortie :</strong> {{ \Carbon\Carbon::parse($sortie->date_sortie)->format('d/m/Y') }}
        </div>
    </div>
    <div class="mb-3">
        <strong>Dépôt source :</strong> Pharmacie centrale
    </div>

    <!-- Tableau des produits livrés -->
    <table class="table table-bordered align-middle" style="background: #fafbfc;">
        <thead class="table-light">
            <tr>
                <th style="width:5%">#</th>
                <th style="width:55%">Produit</th>
                <th style="width:20%">Quantité sortie</th>
                <th style="width:20%">Unité</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sortie->details as $detail)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $detail->produit->nom ?? '—' }}</td>
                    <td>{{ $detail->quantite ?? $detail->quantite_sortie }}</td>
                    <td>{{ $detail->produit->unite ?? '—' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Signatures -->
     <br>
    <div style="display: flex; justify-content: space-between; margin-top: 60px;">
        <div style="width:40%; text-align:center;">
            <div style="height: 60px;"></div>
            <div style="border-top:2px solid #333; width:70%; margin:0 auto 8px auto;"></div>
            <span class="text-muted">Signature Chef de la pharmacie</span>
        </div>
        <div style="width:40%; text-align:center;">
            <div style="height: 60px;"></div>
            <div style="border-top:2px solid #333; width:70%; margin:0 auto 8px auto;"></div>
            <span class="text-muted">Signature Chef du service</span>
        </div>
    </div>

    
</div>
@endsection
