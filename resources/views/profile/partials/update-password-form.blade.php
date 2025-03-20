
<section class="sign-up">
    
    <header>
        <h1 class="sign-up__title">{{ __('Update Password') }}</h1>
        <p class="sign-up__subtitle">{{ __('Ensure your account is using a long, random password to stay secure.') }}</p>
    </header>

    <form class="sign-up-form form" method="post" action="{{ route('password.update') }}">
        @csrf
        @method('put')

        <!-- Mot de passe actuel -->
        <label class="form-label-wrapper">
            <p class="form-label">{{ __('Current Password') }}</p>
            <input class="form-input" id="update_password_current_password" name="current_password" type="password" autocomplete="current-password">
            @error('current_password') <span class="text-danger">{{ $message }}</span> @enderror
        </label>

        <!-- Nouveau mot de passe -->
        <label class="form-label-wrapper">
            <p class="form-label">{{ __('New Password') }}</p>
            <input class="form-input" id="update_password_password" name="password" type="password" autocomplete="new-password">
            @error('password') <span class="text-danger">{{ $message }}</span> @enderror
        </label>

        <!-- Confirmation du mot de passe -->
        <label class="form-label-wrapper">
            <p class="form-label">{{ __('Confirm Password') }}</p>
            <input class="form-input" id="update_password_password_confirmation" name="password_confirmation" type="password" autocomplete="new-password">
            @error('password_confirmation') <span class="text-danger">{{ $message }}</span> @enderror
        </label>

        <!-- Bouton Sauvegarder -->
        <button class="form-btn primary-default-btn transparent-btn">{{ __('Save') }}</button>

        <!-- Message de succès -->
        @if (session('status') === 'password-updated')
            <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-green-600 dark:text-green-400 mt-4">
                {{ __('Enregistrer.') }}
            </p>
        @endif
    </form>
    
</section>