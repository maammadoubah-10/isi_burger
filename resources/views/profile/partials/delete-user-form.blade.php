<section class="sign-up">
    <header>
        <h1 class="sign-up__title">{{ __('Delete Account') }}</h1>
        <p class="sign-up__subtitle">{{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}</p>
    </header>

    <button class="form-btn danger-default-btn transparent-btn" x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')">
        {{ __('Delete Account') }}
    </button>

    <!-- Modal de confirmation -->
    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="sign-up__title">{{ __('Are you sure you want to delete your account?') }}</h2>
            <p class="sign-up__subtitle">{{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}</p>

            <!-- Mot de passe -->
            <label class="form-label-wrapper">
                <p class="form-label">{{ __('Password') }}</p>
                <input class="form-input" id="password" name="password" type="password" placeholder="{{ __('Password') }}">
                @error('password') <span class="text-danger">{{ $message }}</span> @enderror
            </label>

            <!-- Boutons -->
            <div class="mt-6 flex justify-end gap-4">
                <button type="button" class="form-btn secondary-default-btn transparent-btn" x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </button>
                <button type="submit" class="form-btn danger-default-btn transparent-btn">
                    {{ __('Supprimer le compte') }}
                </button>
            </div>
        </form>
    </x-modal>
</section>