@extends('layouts.app')

@section('content')

<style>
/* ✅ Styles Généraux */
.users-table {
    margin: 4%;
    padding: 20px;
    border-radius: 8px;
    background-color: white;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
}

/* ✅ Style du Titre */
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
}

/* ✅ Style des en-têtes */
.posts-table th {
    background-color: #007bff;
    color: white;
    font-weight: bold;
    text-transform: uppercase;
    padding: 12px;
    text-align: center;
}

/* ✅ Style des cellules */
.posts-table td {
    padding: 12px;
    text-align: center;
    border-bottom: 1px solid #ddd;
}

/* ✅ Couleurs de colonnes */
.posts-table tbody tr:nth-child(even) {
    background-color: #f8f9fa;
}

.posts-table tbody tr:hover {
    background-color: #e3f2fd;
    transform: scale(1.02);
}

/* ✅ Style des Checkboxes */
.users-table__checkbox {
    display: flex;
    align-items: center;
    gap: 8px;
}

/* ✅ Input Quantité */
.form-input {
    padding: 6px;
    width: 60px;
    border-radius: 5px;
    border: 1px solid #ccc;
    text-align: center;
}

/* ✅ Style des Images */
.categories-table-img img {
    width: 80px;
    height: 80px;
    border-radius: 5px;
    object-fit: cover;
}

/* ✅ Bouton Commander */
.form-btn {
    display: block;
    width: 100%;
    padding: 10px;
    font-size: 16px;
    text-align: center;
    background: #28a745;
    color: white;
    border: none;
    border-radius: 5px;
    transition: 0.3s;
    cursor: pointer;
}

.form-btn:hover {
    background: #218838;
}

/* ✅ Pagination */
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
    padding: 6px 10px;
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
    <h1 class="sign-up__title">🍔 Passer une Commande</h1>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form class="sign-up-form form" action="{{ route('commandes.store') }}" method="POST">
        @csrf
        <table class="posts-table">
            <thead>
                <tr class="users-table-info">
                    <th>Burger</th>
                    <th>Prix</th>
                    <th>Quantité</th>
                    <th>Image</th>
                </tr>
            </thead>
            <tbody>
                @foreach($burgers as $burger)
                <tr>
                    <!-- Burger -->
                    <td>
                        <label class="users-table__checkbox">
                            <input type="checkbox" name="burgers[]" value="{{ $burger->id }}">
                            {{ $burger->nom }}
                        </label>
                    </td>

                    <!-- Prix -->
                    <td style="color: #28a745; font-weight: bold;">{{ $burger->prix }} F</td>

                    <!-- Quantité -->
                    <td>
                        <input type="number" name="quantites[{{ $burger->id }}]" class="form-input" min="1" max="{{ $burger->stock }}" value="1">
                    </td>

                    <!-- Image -->
                    <td>
                        <div class="categories-table-img">
                            <img src="{{ asset('storage/'.$burger->image) }}" alt="Burger Image">
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        

        <!-- ✅ Bouton Commander -->
        <button type="submit" class="form-btn">🛒 Commander</button>
    </form>
</div>

@endsection
