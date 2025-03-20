@extends('layouts.guest')

@section('title', 'Connexion')

@section('content')
<article class="sign-up">
    <h1 class="sign-up__title">Bienvenue de retour !</h1>
    <p class="sign-up__subtitle">Connectez-vous à votre compte pour continuer</p>
    <form class="sign-up-form form" method="POST" action="{{ route('login') }}">
        @csrf
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
        <a class="link-info forget-link" href="{{ route('password.request') }}">Mot de passe oublié ?</a>
        <label class="form-checkbox-wrapper">
            <input class="form-checkbox" type="checkbox" name="remember">
            <span class="form-checkbox-label">Se souvenir de moi</span>
        </label>
        <button class="form-btn primary-default-btn transparent-btn">Se connecter</button>

        <div class="text-center mt-5">
            <p class="sign-up__subtitle"><a class="link-info forget-link text-center" href="{{ route('register') }}">Créer un compte !</a></p>
        </div>

    </form>
</article>
@endsection
