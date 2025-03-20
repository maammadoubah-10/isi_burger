@extends('layouts.app')

@section('content')
<style>
    /* ✅ Styles généraux */
    .users-table {
        margin: 4%;
        padding: 20px;
        border-radius: 8px;
        background-color: white;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    }

    .sign-up__title {
        text-align: center;
        font-size: 24px;
        font-weight: bold;
        color: #007bff;
        margin-bottom: 20px;
    }

    /* ✅ Table Style */
    .posts-table {
        width: 100%;
        border-collapse: collapse;
        overflow: hidden;
        border-radius: 8px;
    }

    /* ✅ Styles des en-têtes */
    .posts-table th {
        background-color: #007bff;
        color: white;
        font-weight: bold;
        text-transform: uppercase;
        padding: 12px;
        text-align: center;
    }

    /* ✅ Styles des cellules */
    .posts-table td {
        padding: 12px;
        text-align: center;
        border-bottom: 1px solid #ddd;
        transition: background 0.3s ease-in-out;
    }

    /* ✅ Effet au survol */
    .posts-table tbody tr:hover {
        background-color: #f1f9ff;
        transform: scale(1.02);
    }

    /* ✅ Couleurs des statuts */
    .badge-active {
        background-color: #4CAF50; /* Vert */
        color: white;
        padding: 6px 12px;
        border-radius: 12px;
        font-weight: bold;
    }

    .badge-pending {
        background-color: #FFC107; /* Jaune */
        color: black;
        padding: 6px 12px;
        border-radius: 12px;
        font-weight: bold;
    }

    .badge-primary {
        background-color: #2196F3; /* Bleu */
        color: white;
        padding: 6px 12px;
        border-radius: 12px;
        font-weight: bold;
    }

    .badge-danger {
        background-color: #F44336; /* Rouge */
        color: white;
        padding: 6px 12px;
        border-radius: 12px;
        font-weight: bold;
    }

    .badge-secondary {
        background-color: #9E9E9E; /* Gris */
        color: white;
        padding: 6px 12px;
        border-radius: 12px;
        font-weight: bold;
    }

    /* ✅ Produits listés */
    .product-item {
        margin-bottom: 5px;
        font-size: 14px;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    /* ✅ Images des burgers */
    .categories-table-img img {
        width: 80px;
        height: 80px;
        border-radius: 8px;
        object-fit: cover;
        transition: transform 0.3s;
    }

    .categories-table-img img:hover {
        transform: scale(1.1);
    }

    /* ✅ Pagination stylisée */
    .pagination {
        display: flex;
        justify-content: center;
        margin-top: 20px;
    }

    .pagination .page-item {
        margin: 0 5px;
    }

    .pagination .page-item a, 
    .pagination .active span {
        padding: 8px 12px;
        border-radius: 5px;
        color: white;
        background: #007bff;
        text-decoration: none;
        transition: 0.3s;
        font-size: 14px;
    }

    .pagination .page-item a:hover {
        background: #0056b3;
    }
</style>

<div class="users-table">
    <h1 class="sign-up__title">📦 Mes Commandes</h1>

    @if ($commandes->isEmpty())
        <p class="sign-up__subtitle">Aucune commande passée.</p>
        <i class="fas fa-shopping-cart fa-3x" style="color: #ccc; display: block; text-align: center;"></i>
    @else
        <table class="posts-table">
            <thead>
                <tr class="users-table-info">
                    <th>N°</th>
                    <th>Montant Total</th>
                    <th>Statut</th>
                    <th>Produits</th>
                    <th>Images</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($commandes as $commande)
                <tr>
                    <!-- Numéro de commande -->
                    <td><strong>#{{ $commande->id }}</strong></td>

                    <!-- Montant total -->
                    <td style="color: #28a745; font-weight: bold;">{{ $commande->montant_total }} FCFA</td>

                    <!-- Statut de la commande -->
                    <td>
                        @if ($commande->statut === 'payee')
                            <span class="badge-active">Payée</span>
                        @elseif ($commande->statut === 'prete')
                            <span class="badge-pending">Prête</span>
                        @elseif ($commande->statut === 'en_preparation')
                            <span class="badge-primary">En préparation</span>
                        @elseif ($commande->statut === 'annulee')
                            <span class="badge-danger">Annulée</span>
                        @else
                            <span class="badge-secondary">{{ ucfirst($commande->statut) }}</span>
                        @endif
                    </td>

                    <!-- Produits de la commande -->
                    <td>
                        @foreach($commande->burgers as $burger)
                            <div class="product-item">
                                🍔 {{ $burger->nom }} (x{{ $burger->pivot->quantite }})
                            </div>
                        @endforeach
                    </td>

                    <!-- Image -->
                    <td>
                        <div class="categories-table-img">
                            @foreach($commande->burgers as $burger)
                                <img src="{{ asset('storage/'.$burger->image) }}" alt="Burger Image">
                            @endforeach
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- ✅ Pagination -->
        @if($commandes instanceof \Illuminate\Pagination\LengthAwarePaginator)
            <div class="pagination">
                {{ $commandes->links() }}
            </div>
        @endif
    @endif
</div>

@endsection
