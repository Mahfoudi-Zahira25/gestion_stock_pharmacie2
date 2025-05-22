@extends('layouts.app')

@section('content')

{{-- Styles spécifiques au dashboard --}}
<style>
    body {
        background-color: #e0f2ff;
    }
    /* Structure de la navigation */
    .nav-pills {
        border-bottom: 2px solid #eaeaea;
        padding-bottom: 10px;
        margin-bottom: 2rem;
    }

    .nav-link {
        font-weight: 600;
        color: #4a5568; /* Gris foncé */
        padding: 12px 20px;
        border-radius: 6px;
        transition: all 0.3s ease;
    }

    .nav-link:hover,
    .nav-link.active {
        background-color: #2b6cb0; /* Bleu corporate */
        color: white !important;
        box-shadow: 0 4px 10px rgba(43, 108, 176, 0.3);
    }

    /* Dropdown menu */
    .nav-item.dropdown:hover .dropdown-menu {
        display: block;
        margin-top: 0;
        border-radius: 6px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    /* Titre principal */
    h1.text-center {
        font-weight: 700;
        font-size: 2.5rem;
        color:rgb(11, 87, 131);
        margin-bottom: 3rem;
        letter-spacing: 0.06em;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    /* Cartes statistiques */
    .stat-card {
        background-color: #ffffff;
        border-radius: 10px;
        box-shadow: 0 8px 16px rgba(26, 46, 228, 0.05);
        padding: 2rem 1.5rem;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        cursor: default;
    }

    .stat-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 16px 32px rgba(0,0,0,0.12);
    }

    .stat-title {
        font-size: 1.15rem;
        color: #4a5568;
        margin-bottom: 0.8rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .stat-value {
        font-size: 2.8rem;
        font-weight: 700;
        color: #2b6cb0; /* Bleu corporate */
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    /* Responsive */
    @media (max-width: 767px) {
        .stat-card {
            margin-bottom: 1.8rem;
        }
    }
</style>

<div class="mb-5">
    <nav class="nav nav-pills justify-content-center flex-wrap gap-3">

        <a class="nav-link {{ request()->is('fournisseurs*') ? 'active' : '' }}" href="{{ route('fournisseurs.index') }}">
            Gestion Fournisseurs
        </a>

        <a class="nav-link {{ request()->is('commandes_fournisseur*') ? 'active' : '' }}" href="{{ route('commandes_fournisseur.index') }}">
            Commande Fournisseur
        </a>

        <a href="{{ route('entrees.service.create') }}" class="nav-link {{ request()->is('entrees.service*') ? 'active' : '' }}">
    <i class="bi bi-box-arrow-in-down"></i> Entrer en stock
</a>


        {{-- Dropdown Sortie de Stock --}}
        <div class="nav-item dropdown">
            <a class="nav-link dropdown-toggle {{ request()->is('sortie_vers_patient*') || request()->is('sortie_depots*') ? 'active' : '' }}"
               href="#" id="dropdownSortie" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Sortie de Stock
            </a>
            <ul class="dropdown-menu text-center" aria-labelledby="dropdownSortie">
                <li><a class="dropdown-item" href="{{ route('sortie_vers_patient.index') }}">Sortie vers Patient</a></li>
                <li><a class="dropdown-item" href="{{ route('sortie_depots.index') }}">Sortie vers Service</a></li>
            </ul>
        </div>

        <a class="nav-link {{ request()->is('cmd-internes*') ? 'active' : '' }}" href="{{ route('cmd_internes.index') }}">
            Commande Interne des Services
        </a>

    </nav>
</div>

<h1 class="text-center">Tableau de Bord - Chef de Pharmacie</h1>

<div class="container">
    <div class="row gy-4 justify-content-center">

        <div class="col-md-3 col-sm-6">
            <div class="stat-card">
                <div class="stat-title">Nombre total des produits</div>
                <div class="stat-value">{{ $totalProduits ?? 0 }}</div>

            </div>
        </div>

        <div class="col-md-3 col-sm-6">
            <div class="stat-card">
                <div class="stat-title">Commandes internes traitées</div>
                <div class="stat-value">{{ $totalCommandesInternes ?? 0 }}</div>
            </div>
        </div>

        <div class="col-md-3 col-sm-6">
            <div class="stat-card">
                <div class="stat-title">Alertes de stock actives</div>
                <div class="stat-value">{{ $alertesStock ?? 0 }}</div>
            </div>
        </div>

        <div class="col-md-3 col-sm-6">
            <div class="stat-card">
                <div class="stat-title">Activités des services</div>
                <div class="stat-value">{{ $activitesServices ?? 0 }}</div>
            </div>
        </div>

    </div>
</div>

@endsection
