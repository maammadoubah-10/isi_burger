@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Détails de la Commande #{{ $commande->id }}</h2>

    <p><strong>Client :</strong> {{ $commande->client ? $commande->client->name : 'Inconnu' }}</p>

    <p><strong>Montant Total :</strong> {{ $commande->montant_total }} €</p>
    <p><strong>Statut :</strong> {{ ucfirst($commande->statut) }}</p>

    <h4>Produits commandés :</h4>
    <ul>
        @foreach($commande->burgers as $burger)
            <li>{{ $burger->nom }} - {{ $burger->pivot->quantite }}x</li>
        @endforeach
    </ul>

    <!-- @if($commande->statut != 'payee')
        <a href="{{ route('paiements.store', $commande) }}" class="btn btn-success">Payer</a>
    @endif -->
</div>
@endsection
