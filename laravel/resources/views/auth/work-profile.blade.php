<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('work') }}">
            @csrf

            <!-- Sponsoring Organization -->
            <div>
                <x-label for="Org" :value="__('Sponsoring Organization')" />

                <x-input id="org" class="block mt-1 w-full" type="text" name="org" :value="old('org')" required autofocus />
            </div>

            <!-- Current Work Station -->
            <div>
                <x-label for="Work" :value="__('Current Work Station')" />

                <x-input id="work" class="block mt-1 w-full" type="text" name="work" :value="old('work')" required autofocus />
            </div>



            <div class="pagination flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}\">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Proceed') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>