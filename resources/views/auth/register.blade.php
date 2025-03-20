@extends('layouts.guest')

@section('title', 'Inscription')

@section('content')
<article class="sign-up">
    <h1 class="sign-up__title">Inscrivez-vous</h1>
    <p class="sign-up__subtitle">Commencez à créer la meilleure expérience utilisateur</p>
    <form class="sign-up-form form" method="POST" action="{{ route('register') }}">
        @csrf
        <label class="form-label-wrapper">
            <p class="form-label">Nom</p>
            <input class="form-input" type="text" name="name" placeholder="Entrez votre nom" value="{{ old('name') }}" required>
            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
        </label>
        <label class="form-label-wrapper">
            <p class="form-label">Email</p>
            <input class="form-input" type="email" name="email" placeholder="Entrez votre email" value="{{ old('email') }}" required>
            @error('email') <span class="text-danger">{{ $message }}</span> @enderror
        </label>
        
        <label class="form-label-wrapper">
            <p class="form-label">Mot de passe</p>
            <input class="form-input" type="password" name="password" placeholder="Entrez votre mot de passe" required>
            @error('password') <span class="text-danger">{{ $message }}</span> @enderror
        </label>
        <label class="form-label-wrapper">
            <p class="form-label">Confirmez le mot de passe</p>
            <input class="form-input" type="password" name="password_confirmation" placeholder="Confirmez votre mot de passe" required>
        </label>
        <button class="form-btn primary-default-btn transparent-btn">S'inscrire</button>


        <div class="text-center mt-5">
            <p class="sign-up__subtitle"><a class="link-info forget-link text-center" href="{{ route('login') }}">Se connecter !</a></p>
        </div>


    </form>
</article>
@endsection
