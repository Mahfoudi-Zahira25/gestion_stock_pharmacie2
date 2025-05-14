@extends('layouts.app')

@section('content')
    {{-- ✅ Menu de navigation interne --}}
    <div class="mb-4">
        <nav class="nav nav-pills justify-content-center">
            <a class="nav-link {{ request()->is('fournisseurs*') ? 'active' : '' }}" href="{{ route('fournisseurs.index') }}">Gestion Fournisseurs</a>
            <a href="{{ route('commandes_fournisseur.index') }}">CMD fournisseur</a>
            <a class="nav-link {{ request()->is('entrer-stock*') ? 'active' : '' }}" href="{{ route('entrer_stock.index') }}">Entrer en Stock</a>
            {{-- <a class="nav-link {{ request()->is('sortie-stock*') ? 'active' : '' }}" href="{{ route('sortie_stock.index') }}">Sortie Stock</a> --}}
            <a class="nav-link {{ request()->is('cmd-internes*') ? 'active' : '' }}" href="{{ route('cmd_internes.index') }}">CMD Interne Services</a>
        </nav>
    </div>

    {{-- ✅ Titre --}}
    <h1 class="text-center mb-5">Bienvenue Chef</h1>

    {{-- ✅ Cartes de statistiques --}}
    <div class="container">
        <div class="row text-center">
            <div class="col-md-3">
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <h5 class="card-title">NBR totale des produits</h5>
                        <p class="card-text">150</p> {{-- Remplace "150" par une variable dynamique si nécessaire --}}
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <h5 class="card-title">NBR commandes internes</h5>
                        <p class="card-text">45</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Alertes de stock</h5>
                        <p class="card-text">6</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Activités des services</h5>
                        <p class="card-text">12</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


