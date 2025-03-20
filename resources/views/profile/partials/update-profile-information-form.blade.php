<section class="sign-up">
    <header>
        <h1 class="sign-up__title">{{ __('Profile Information') }}</h1>
        <p class="sign-up__subtitle">{{ __("Update your account's profile information and email address.") }}</p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form class="sign-up-form form" method="post" action="{{ route('profile.update') }}">
        @csrf
        @method('patch')

        <!-- Nom -->
        <label class="form-label-wrapper">
            <p class="form-label">{{ __('Name') }}</p>
            <input class="form-input" id="name" name="name" type="text" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
        </label>

        <!-- Email -->
        <label class="form-label-wrapper">
            <p class="form-label">{{ __('Email') }}</p>
            <input class="form-input" id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required autocomplete="username">
            @error('email') <span class="text-danger">{{ $message }}</span> @enderror
        </label>

        <!-- Vérification de l'email -->
        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
            <div class="mt-4">
                <p class="text-sm text-gray-800 dark:text-gray-200">
                    {{ __('Your email address is unverified.') }}
                    <button form="send-verification" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100">
                        {{ __('Click here to re-send the verification email.') }}
                    </button>
                </p>
                @if (session('status') === 'verification-link-sent')
                    <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                        {{ __('A new verification link has been sent to your email address.') }}
                    </p>
                @endif
            </div>
        @endif

        <!-- Bouton Sauvegarder -->
        <button class="form-btn primary-default-btn transparent-btn">{{ __('Save') }}</button>

        <!-- Message de succès -->
        @if (session('status') === 'profile-updated')
            <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-green-600 dark:text-green-400 mt-4">
                {{ __('Enregistrer.') }}
            </p>
        @endif
    </form>
</section>