<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            Update Image Profile
        </h2>
    </header>

    <form method="post" class="mt-6 space-y-6" wire:submit.prevent="updateImage">
        <div class="flex">
            <div class="{{ $tempImage ? 'w-1/2' : 'w-full' }}">
                <span class="font-semibold text-slate-800 dark:text-slate-200">
                    Old Image
                </span>
                <span class="flex justify-center">
                    <img src="{{ auth()->user()->profile->image_path ?? asset('assets/images/default_avatar.jpg') }}" class="object-cover w-64 h-64 rounded-full shadow-xl shadow-slate-400 dark:shadow-slate-700"
                        alt="">
                </span>
            </div>
            @if ($tempImage)
                <div class="w-1/2">
                    <span class="font-semibold text-slate-800 dark:text-slate-200">
                        Image Preview
                    </span>
                    <span class="flex justify-center">
                        <img src="{{ $tempImage->temporaryUrl() }}" class="object-cover w-64 h-64 rounded-full shadow-xl shadow-slate-400 dark:shadow-slate-700"
                            alt="">
                    </span>
                </div>
            @endif
        </div>

        <div>
            <x-input.input-label for="image" :value="__('Image')" />
            <x-input.file-input id="image" name="image" wire:model.lazy='tempImage' type="file"
                class="block w-full mt-1" autocomplete="image" accept="image/*" />
            <x-input.input-error :messages="$errors->get('tempImage ')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end gap-4">
            <x-button.primary-button>{{ __('Save') }}</x-button.primary-button>
        </div>
    </form>
</section>
