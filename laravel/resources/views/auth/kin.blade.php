<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('kin') }}">
            @csrf

            <!-- Name of next of kin -->
            <div>
                <x-label for="name" :value="__('Name')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            </div>

            <!-- Relationship with next of kin -->
            <div>
                <x-label for="Relationship" :value="__('Relationship with next of kin')" />

                <x-input id="relationship" class="block mt-1 w-full" type="text" name="relationship" :value="old('relationship')" required autofocus />
            </div>

            <!-- Mobile No. -->
            <div class="mt-4">
                <x-label for="Mobile No." :value="__('Mobile No.')" />

                <x-input id="mobile_no" class="block mt-1 w-full" type="number" name="mobile_no" :value="old('mobile_no')" required />
            </div>

            <!-- Physical Address -->
            <div>
                <x-label for="Physical Address" :value="__('Physical Address')" />

                <x-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address')" required autofocus />
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