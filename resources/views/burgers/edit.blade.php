@extends('layouts.app')

@section('content')

<style>
/* ✅ Style général */
.sign-up {
    max-width: 450px; /* 📏 Réduction de la largeur */
    margin: 5% auto;
    padding: 15px;
    border-radius: 8px;
    background: white;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    text-align: center;
}

.sign-up__title {
    font-size: 22px;
    font-weight: bold;
    color: #007bff;
}

.sign-up__subtitle {
    font-size: 14px;
    color: #555;
    margin-bottom: 10px;
}

/* ✅ Champs du formulaire */
.form-label-wrapper {
    display: block;
    text-align: left;
    margin-bottom: 12px;
}

.form-label {
    font-size: 13px;
    font-weight: bold;
    color: #333;
}

.form-input {
    width: 100%;
    padding: 8px;
    border: 1px solid #ddd;
    border-radius: 5px;
    transition: border 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
    font-size: 13px;
}

.form-input:focus {
    border-color: #007bff;
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
    outline: none;
}

/* ✅ Style de l’image */
.burger-img-preview {
    display: block;
    margin-top: 10px;
    border-radius: 5px;
    width: 100px;
    height: auto;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
}

/* ✅ Bouton */
.form-btn {
    width: 100%;
    padding: 8px;
    background: #007bff;
    color: white;
    font-size: 14px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background 0.3s ease-in-out;
}

.form-btn:hover {
    background: #0056b3;
}

/* ✅ Message d'erreur */
.text-danger {
    color: #dc3545;
    font-size: 12px;
}

/* ✅ Alertes d'erreur */
.alert {
    padding: 8px;
    background: #ffdddd;
    color: #d9534f;
    border-left: 5px solid #d9534f;
    border-radius: 5px;
    margin-bottom: 12px;
    text-align: left;
}
</style>

<article class="sign-up">
    <h1 class="sign-up__title">Modifier le Burger</h1>
    <p class="sign-up__subtitle">Mettez à jour les informations</p>

    <!-- ✅ Messages d'erreur -->
    @if ($errors->any())
        <div class="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- ✅ Formulaire -->
    <form class="sign-up-form form" action="{{ route('burgers.update', $burger) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Nom -->
        <label class="form-label-wrapper">
            <p class="form-label">Nom</p>
            <input class="form-input" type="text" name="nom" placeholder="Nom du burger" value="{{ old('nom', $burger->nom) }}" required>
            @error('nom') <span class="text-danger">{{ $message }}</span> @enderror
        </label>

        <!-- Prix -->
        <label class="form-label-wrapper">
            <p class="form-label">Prix</p>
            <input class="form-input" type="number" name="prix" placeholder="Prix (FCFA)" value="{{ old('prix', $burger->prix) }}" required>
            @error('prix') <span class="text-danger">{{ $message }}</span> @enderror
        </label>

        <!-- Image -->
        <label class="form-label-wrapper">
            <p class="form-label">Image</p>
            <input class="form-input" type="file" name="image">
            @if($burger->image)
                <img src="{{ asset('storage/'.$burger->image) }}" alt="Burger Image" class="burger-img-preview">
            @endif
            @error('image') <span class="text-danger">{{ $message }}</span> @enderror
        </label>

        <!-- Description -->
        <label class="form-label-wrapper">
            <p class="form-label">Description</p>
            <textarea class="form-input" name="description" placeholder="Description">{{ old('description', $burger->description) }}</textarea>
            @error('description') <span class="text-danger">{{ $message }}</span> @enderror
        </label>

        <!-- Stock -->
        <label class="form-label-wrapper">
            <p class="form-label">Stock</p>
            <input class="form-input" type="number" name="stock" placeholder="Stock disponible" value="{{ old('stock', $burger->stock) }}" required>
            @error('stock') <span class="text-danger">{{ $message }}</span> @enderror
        </label>

        <!-- ✅ Bouton Mettre à jour -->
        <button class="form-btn">Mettre à jour</button>
    </form>
</article>

@endsection
