<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('course') }}">
            @csrf

            <!-- Course Title -->
            <div>
                <x-label for="name" :value="__('Course Title')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            </div>

            <!-- Course Duration -->
            <div>
                <x-label for="from" :value="__('From')" />

                <x-input id="From" class="block mt-1 w-full" type="date" name="From" required autofocus />
            </div>

            <div>
                <x-label for="To" :value="__('To')" />

                <x-input id="To" class="block mt-1 w-full" type="date" name="To" required autofocus />
            </div>

            <div class="pagination flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Proceed') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>