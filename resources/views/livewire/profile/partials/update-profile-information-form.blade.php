<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form method="post" class="grid grid-cols-2 gap-4 mt-6" wire:submit.prevent="updateProfileInformation">
        <div>
            <x-input.input-label for="name" :value="__('Name')" />
            <x-input.text-input id="name" name="name" type="text" wire:model.lazy='userForm.name'
                class="block w-full mt-1" required autofocus autocomplete="name" />
            <x-input.input-error class="mt-2" :messages="$errors->get('userForm.name')" />
        </div>

        <div>
            <x-input.input-label for="username" :value="__('Username')" />
            <x-input.text-input id="username" name="username" type="text" class="block w-full mt-1"
                wire:model.lazy='userForm.username'  wire:model.lazy='userForm.username' required autofocus autocomplete="username" />
            <x-input.input-error class="mt-2" :messages="$errors->get('userForm.username')" />
        </div>

        <div>
            <x-input.input-label for="email" :value="__('Email')" />
            <x-input.text-input id="email" name="email" type="email" class="block w-full mt-1"  wire:model.lazy='userForm.email'
                required autocomplete="username" />
            <x-input.input-error class="mt-2" :messages="$errors->get('userForm.email')" />
        </div>

        <div>
            <x-input.input-label for="phone" value="Phone" />
            <x-input.text-input id="phone" name="phone"
                wire:model.lazy='userForm.profile.phone' type="number" class="block w-full mt-1" />
            <x-input.input-error :messages="$errors->get('userForm.profile.phone')" class="mt-2" />
        </div>

        <div class="col-span-2">
            <x-input.input-label for="address" value="Address" />
            <x-input.textarea-input id="address" name="address"
                wire:model.lazy='userForm.profile.address' type="text" class="block w-full mt-1" />
            <x-input.input-error :messages="$errors->get('userForm.profile.address')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end col-span-2 gap-4">
            <x-button.primary-button>{{ __('Save') }}</x-button.primary-button>
        </div>
    </form>
</section>
