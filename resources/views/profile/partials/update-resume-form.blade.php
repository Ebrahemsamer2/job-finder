<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Your Resume') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your resume") }}
        </p>
    </header>

    @if(auth()->user()->resume)
        <form id="donwload_resume_form" method="POST" action="{{ route('profile.download_resume') }}">@csrf</form>
    @endif 

    <form method="post" action="{{ route('profile.update_resume') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="resume" :value="__('Resume')" />
            <x-file-input id="resume" name="resume" type="file" class="mt-1 block w-full" required />
            <x-input-error class="mt-2" :messages="$errors->get('resume')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>
            @if(auth()->user()->resume)
                <x-secondary-button onclick="event.preventDefault(); document.getElementById('donwload_resume_form').submit();">{{ __('Download Resume') }}</x-secondary-button>
            @endif

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
