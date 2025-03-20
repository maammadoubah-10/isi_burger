@extends('layouts.app')

@section('content')

<style>
/* ✅ Style général du formulaire */
.sign-up {
    max-width: 450px; /* 📏 Réduction de la largeur */
    margin: 5% auto;
    padding: 15px; /* 📏 Réduction du padding */
    border-radius: 8px;
    background: white;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    text-align: center;
}

.sign-up__title {
    font-size: 22px; /* 📏 Réduction de la taille */
    font-weight: bold;
    color: #007bff;
}

.sign-up__subtitle {
    font-size: 14px; /* 📏 Réduction */
    color: #555;
    margin-bottom: 10px;
}

/* ✅ Champs du formulaire */
.form-label-wrapper {
    display: block;
    text-align: left;
    margin-bottom: 12px; /* 📏 Réduction */
}

.form-label {
    font-size: 13px; /* 📏 Réduction */
    font-weight: bold;
    color: #333;
}

.form-input {
    width: 100%;
    padding: 8px; /* 📏 Réduction */
    border: 1px solid #ddd;
    border-radius: 5px;
    transition: border 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
    font-size: 13px; /* 📏 Réduction */
}

.form-input:focus {
    border-color: #007bff;
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
    outline: none;
}

/* ✅ Bouton */
.form-btn {
    width: 100%;
    padding: 8px; /* 📏 Réduction */
    background: #007bff;
    color: white;
    font-size: 14px; /* 📏 Réduction */
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
    padding: 8px; /* 📏 Réduction */
    background: #ffdddd;
    color: #d9534f;
    border-left: 5px solid #d9534f;
    border-radius: 5px;
    margin-bottom: 12px; /* 📏 Réduction */
    text-align: left;
}
</style>

<article class="sign-up">
    <h1 class="sign-up__title">Ajouter un Burger</h1>
    <p class="sign-up__subtitle">Créez un nouveau burger</p>

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
    <form class="sign-up-form form" action="{{ route('burgers.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Nom -->
        <label class="form-label-wrapper">
            <p class="form-label">Nom</p>
            <input class="form-input" type="text" name="nom" placeholder="Nom du burger" value="{{ old('nom') }}" required>
            @error('nom') <span class="text-danger">{{ $message }}</span> @enderror
        </label>

        <!-- Prix -->
        <label class="form-label-wrapper">
            <p class="form-label">Prix</p>
            <input class="form-input" type="number" name="prix" placeholder="Prix (FCFA)" value="{{ old('prix') }}" required>
            @error('prix') <span class="text-danger">{{ $message }}</span> @enderror
        </label>

        <!-- Image -->
        <label class="form-label-wrapper">
            <p class="form-label">Image</p>
            <input class="form-input" type="file" name="image">
            @error('image') <span class="text-danger">{{ $message }}</span> @enderror
        </label>

        <!-- Description -->
        <label class="form-label-wrapper">
            <p class="form-label">Description</p>
            <textarea class="form-input" name="description" placeholder="Description">{{ old('description') }}</textarea>
            @error('description') <span class="text-danger">{{ $message }}</span> @enderror
        </label>

        <!-- Stock -->
        <label class="form-label-wrapper">
            <p class="form-label">Stock</p>
            <input class="form-input" type="number" name="stock" placeholder="Stock disponible" value="{{ old('stock', 0) }}" required>
            @error('stock') <span class="text-danger">{{ $message }}</span> @enderror
        </label>

        <!-- ✅ Bouton Enregistrer -->
        <button class="form-btn">Enregistrer</button>
    </form>
</article>

@endsection
