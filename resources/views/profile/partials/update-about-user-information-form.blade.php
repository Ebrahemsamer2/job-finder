<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('About Me') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your about me information") }}
        </p>
    </header>

    <form method="post" action="{{ route('profile.update_about_me_info') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="summery" :value="__('Summery')" />
            <x-textarea-input id="summery" name="summery" type="text" class="mt-1 block w-full" :value="old('summery', $user->summery)" required autofocus autocomplete="summery" />
            <x-input-error class="mt-2" :messages="$errors->get('summery')" />
        </div>

        <div>
            <x-input-label for="web" :value="__('Website')" />
            <x-text-input id="web" name="web" type="url" class="mt-1 block w-full" :value="old('web', $user->web)" required autofocus autocomplete="web" />
            <x-input-error class="mt-2" :messages="$errors->get('web')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
