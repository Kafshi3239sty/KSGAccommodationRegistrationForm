<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-label for="name" :value="__('Name')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            </div>
            

            <!-- ID/Passport No. -->
            <div class="mt-4">
                <x-label for="ID/Passport No." :value="__('ID/Passport No.')" />

                <x-input id="Passport" class="block mt-1 w-full" type="number" name="Passport" :value="old('Passport')" required />
            </div>

            <!-- Nationality -->
            <div class="mt-4">
                <x-label for="Nationality" :value="__('Nationality')" />
                <select id="Nationality" class="form-select-lg mb-3 form-control" name="Nationality" required name="Nationality">
                    @foreach ($nationalities as $nationality)
                    <option value="{{$nationality->id}}">{{ $nationality->Name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Gender -->
            <div class="mt-4">
                <x-label for="Gender" :value="__('Gender')" />
                <select id="Gender" class="form-select-lg mb-3 form-control" name="Gender" required name="Gender">
                @foreach ($genders as $gender)
                    <option value="{{$gender->id}}">{{ $gender->type }}</option>
                    @endforeach
                </select>
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
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('confirm') }}\">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Proceed') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>