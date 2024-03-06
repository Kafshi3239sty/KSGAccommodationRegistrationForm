<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <img src="{{ route('generateqrcode') }}" alt="QR Code">
    </x-auth-card>
</x-guest-layout>