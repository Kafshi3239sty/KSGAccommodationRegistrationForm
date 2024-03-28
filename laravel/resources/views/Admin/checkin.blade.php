<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
        </x-slot>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />
        <form method="POST" action="{{URL::to('allocate/'.$acc->id)}}">
            @csrf
            @method('PUT')
            <!-- Residential Hostel -->
            <div class="mt-4">
                <x-label for="Residential Hostel" :value="__('Allocate Residential Hostel:')" />

                <x-input id="Residential" class="block mt-1 w-full" type="text" name="Residential" :value="old('Residential')" required />
            </div>

            <!-- Room Number -->
            <div class="mt-4">
                <x-label for="Room Number" :value="__('Allocate Room Number:')" />

                <x-input id="Room" class="block mt-1 w-full" type="text" name="Room" :value="old('Room')" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button class="ml-3">
                    {{ __('Allocate') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>