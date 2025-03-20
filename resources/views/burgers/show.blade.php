@extends('layouts.app')

@section('content')

<style>
    .burger-details-container {
        max-width: 800px;
        margin: 50px auto;
        background: white;
        padding: 25px;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        text-align: center;
    }

    .burger-details-container img {
        width: 100%;
        max-height: 350px;
        object-fit: cover;
        border-radius: 8px;
        margin-bottom: 15px;
    }

    .burger-title {
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 10px;
        color: #007bff;
    }

    .burger-description {
        font-size: 16px;
        color: #555;
        margin-bottom: 15px;
    }

    .burger-price {
        font-size: 20px;
        font-weight: bold;
        color: #28a745;
        margin-bottom: 10px;
    }

    .burger-stock {
        font-size: 16px;
        font-weight: bold;
        color: red;
        margin-bottom: 20px;
    }

    .btn-back {
        background: #007bff;
        color: white;
        padding: 12px;
        border-radius: 8px;
        font-size: 16px;
        text-decoration: none;
        display: inline-block;
        margin-top: 20px;
    }

    .btn-back:hover {
        background: #0056b3;
    }

    .btn-order {
        background: #28a745;
        color: white;
        padding: 12px;
        border-radius: 8px;
        font-size: 16px;
        text-decoration: none;
        display: inline-block;
        margin-top: 20px;
    }

    .btn-order:hover {
        background: #218838;
    }
</style>

<div class="burger-details-container">
    <img src="{{ asset('storage/'.$burger->image) }}" alt="{{ $burger->nom }}">
    
    <h2 class="burger-title">{{ $burger->nom }}</h2>
    <p class="burger-description">{{ $burger->description }}</p>
    <p class="burger-price">Prix : {{ number_format($burger->prix, 2) }} F CFA</p>
    
    @if($burger->enStock())
        <p class="burger-stock" style="color: green;">En stock ({{ $burger->stock }} disponibles)</p>
        <a href="#" class="btn-order">Commander</a>
    @else
        <p class="burger-stock">Rupture de stock</p>
    @endif

    <a href="{{ route('catalogue') }}" class="btn-back">⬅️ Retour au catalogue</a>
</div>

@endsection
