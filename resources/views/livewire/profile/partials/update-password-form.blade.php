<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" class="mt-6 space-y-6" wire:submit.prevent="updatePassword">
        <div>
            <x-input.input-label for="current_password" :value="__('Current Password')" />
            <x-input.text-input id="current_password" name="current_password" wire:model.lazy='changePasswordForm.current_password' type="password" class="block w-full mt-1" autocomplete="current-password" />
            <x-input.input-error :messages="$errors->get('changePasswordForm.current_password')" class="mt-2" />
        </div>

        <div>
            <x-input.input-label for="password" :value="__('New Password')" />
            <x-input.text-input id="password" name="password" wire:model.lazy='changePasswordForm.password' type="password" class="block w-full mt-1" autocomplete="new-password" />
            <x-input.input-error :messages="$errors->get('changePasswordForm.password')" class="mt-2" />
        </div>

        <div>
            <x-input.input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-input.text-input id="password_confirmation" name="password_confirmation" wire:model.lazy='changePasswordForm.password_confirmation' type="password" class="block w-full mt-1" autocomplete="new-password" />
            <x-input.input-error :messages="$errors->get('changePasswordForm.password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-button.primary-button>{{ __('Save') }}</x-button.primary-button>
        </div>
    </form>
</section>
