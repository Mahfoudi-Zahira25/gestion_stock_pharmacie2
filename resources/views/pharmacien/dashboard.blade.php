@extends('layouts.app')

@section('content')
<div class="container text-center mt-5">
    <h2>Bienvenue {{ auth()->user()->name }} !</h2>

    <div class="mt-4">
        <a href="{{ route('fournisseurs.index') }}" class="btn btn-primary btn-lg m-2">👨‍⚕️ Gestion des fournisseurs</a>
        <a href="{{ route('commande-fournisseur.create') }}" class="btn btn-success btn-lg m-2">📦 Passer une commande</a>
        <a href="{{ route('produits.index') }}" class="btn btn-info btn-lg m-2">💊 Gestion des produits</a>
        
    </div>
</div>
@endsection

