@extends('layouts.app')

@section('content')

<style>
/* ✅ Table améliorée */
.users-table {
    margin: 5% auto;
    padding: 20px;
    border-radius: 8px;
    background-color: #fff;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.posts-table {
    width: 100%;
    border-collapse: collapse;
}

.posts-table th, .posts-table td {
    padding: 12px;
    text-align: center;
    border-bottom: 1px solid #ddd;
}

/* ✅ Couleurs et hover */
.posts-table th {
    background-color: #007bff;
    color: white;
    font-weight: bold;
}

.posts-table tbody tr:nth-child(even) {
    background-color: #f8f9fa;
}

.posts-table tbody tr:hover {
    background-color: #e3f2fd;
    transition: 0.3s ease-in-out;
}

/* ✅ Statut */
.badge-active {
    background-color: #28a745;
    color: white;
    padding: 6px 10px;
    border-radius: 5px;
    font-size: 0.9rem;
}

.badge-pending {
    background-color: #dc3545;
    color: white;
    padding: 6px 10px;
    border-radius: 5px;
    font-size: 0.9rem;
}

/* ✅ Menu déroulant actions */
.p-relative {
    position: relative;
}

.dropdown-btn {
    background: transparent;
    border: none;
    cursor: pointer;
}

.users-item-dropdown {
    display: none;
    position: absolute;
    right: 0;
    background: white;
    border-radius: 5px;
    box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.2);
    padding: 8px;
    list-style: none;
    z-index: 10;
    min-width: 120px;
}

.users-item-dropdown li {
    padding: 5px;
    text-align: left;
}

.users-item-dropdown li a, 
.users-item-dropdown li button {
    display: block;
    width: 100%;
    background: none;
    border: none;
    padding: 5px 10px;
    text-align: left;
    color: #333;
    font-size: 14px;
    cursor: pointer;
    transition: background 0.3s;
}

.users-item-dropdown li a:hover, 
.users-item-dropdown li button:hover {
    background: #007bff;
    color: white;
    border-radius: 3px;
}

/* ✅ Affichage du menu quand on clique */
.p-relative .users-item-dropdown {
    display: none;
}

.p-relative.active .users-item-dropdown {
    display: block;
}

/* ✅ Pagination plus compacte */
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

/* ✅ Réduction des flèches */
.pagination .page-item:first-child a,
.pagination .page-item:last-child a {
    font-size: 16px;
    padding: 6px 8px;
}
</style>

<div class="users-table table-wrapper">

    <div class="d-flex" style="display: flex; justify-content: space-between; align-items: center;">
        <h5 class="sign-up__title">🍔 Liste des Burgers</h5>

        <div class="btn">
            <a href="{{ route('burgers.create') }}" class="form-btn primary-default-btn transparent-btn mb-3">
                ➕ Ajouter un Burger
            </a>
        </div>
    </div>

    <table class="posts-table">
        <thead>
            <tr class="users-table-info">
                <th>Image</th>
                <th>Nom</th>
                <th>Prix</th>
                <th>Stock</th>
                <th>Description</th>
                <th>Statut</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($burgers as $burger)
            <tr>
                <!-- Image -->
                <td>
                    <div class="categories-table-img">
                        <picture>
                            <source srcset="{{ asset('storage/'.$burger->image) }}" type="image/webp">
                            <img src="{{ asset('storage/'.$burger->image) }}" alt="Burger Image" width="80" style="border-radius: 5px;">
                        </picture>
                    </div>
                </td>

                <!-- Nom -->
                <td><strong>{{ $burger->nom }}</strong></td>

                <!-- Prix -->
                <td><span style="color: #28a745;">{{ $burger->prix }} FCFA</span></td>

                <!-- Stock -->
                <td>{{ $burger->stock }}</td>

                <!-- Description -->
                <td>{{ Str::limit($burger->description, 50) }}</td>

                <!-- Statut -->
                <td>
                    @if($burger->enStock())
                        <span class="badge-active">En stock</span>
                    @else
                        <span class="badge-pending">Rupture</span>
                    @endif
                </td>

                <!-- Actions -->
                <td class="p-relative">
                    <button class="dropdown-btn transparent-btn" type="button" title="Options" onclick="toggleDropdown(this)">
                        <i data-feather="more-horizontal" aria-hidden="true"></i>
                    </button>
                    <ul class="users-item-dropdown dropdown">
                        <li>
                            <a href="{{ route('burgers.edit', $burger) }}">✏ Modifier</a>
                        </li>
                        <li>
                            <form action="{{ route('burgers.destroy', $burger) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Supprimer ce burger ?')">
                                    ❌ Supprimer
                                </button>
                            </form>
                        </li>
                    </ul>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- ✅ Pagination -->
    <div class="pagination">
        {{ $burgers->links() }}
    </div>

</div>

<script>
function toggleDropdown(button) {
    let parent = button.closest('.p-relative');
    document.querySelectorAll('.p-relative').forEach(el => {
        if (el !== parent) el.classList.remove('active');
    });
    parent.classList.toggle('active');
}

document.addEventListener('click', function(event) {
    if (!event.target.closest('.p-relative')) {
        document.querySelectorAll('.p-relative').forEach(el => el.classList.remove('active'));
    }
});
</script>

@endsection
