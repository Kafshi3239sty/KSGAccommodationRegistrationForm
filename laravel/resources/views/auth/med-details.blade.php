<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('med') }}">
            @csrf


            <!-- Preferrable Hospitals -->
            <div>
                <x-label for="Hospitals" :value="__('Incase of any illness which hospital(s) would you prefer in Nairobi?')" />

                <x-input id="hosp" class="block mt-1 w-full" type="text" name="hosp" :value="old('hosp')" required autofocus />
            </div>


            <!-- Mode of Payment to the hospital, Policy Provider & No. -->
            <div>
                <x-label for="Mode" :value="__('Mode of Payment to the hospital:')" />

                <select class="custom-select custom-select-lg mb-3" onchange="modes(this)" id="showmodes" name="showmodes" required>
                    <option value="0" selected>Mode of Payment to the hospital:</option>
                    <option value="Cash Payment">Cash Payment</option>
                    <option value="Insurance">Insurance</option>
                    <option value="Other">Other</option>
                </select>
            </div>

            <style>
                .d-none {
                    display: none;
                }

            </style>

            <script>
                function modes(paymentMode) {
                    console.log(paymentMode);
                    console.log(paymentMode.value);

                    const mode = document.querySelectorAll('.policy');

                    mode.forEach(hideAll);

                    function hideAll(modetype) {
                        modetype.classList.add('d-none');
                    }


                    if (paymentMode.value === '0') {
                        mode.forEach(showAll);

                        function showAll(modetype) {
                            modetype.classList.remove('d-none');
                        }
                    }

                    if (paymentMode.value === 'Insurance') {
                        document.getElementById("prov").classList.remove('d-none');
                        document.getElementById('policy_no').classList.remove('d-none');
                    }

                    if (paymentMode.value === 'Other') {
                        document.getElementById("specify").classList.remove('d-none')
                    }

                    console.log(mode);
                    console.log(mode.length);
                }

                function descr() {
                    var decision = document.getElementById('cond');

                    if (decision.value == '0') {
                        document.getElementById('Medical_Description').style.visibility('hidden');
                    } 
                    else if (decision.value == 'no') 
                    {
                        document.getElementById('Medical_Description').style.visibility('hidden');
                    } else(decision.value == 'yes') 
                    {
                        document.getElementById('Medical_Description').style.visibility('visible');
                    }

                }
            </script>

            <!-- Insurance Policy Provider -->
            <div>
                <x-label for="Policy Provider" :value="__('Insurance Policy Provider')" />

                <x-input id="prov" class="policy block mt-1 w-full" type="text" name="prov" :value="old('prov')" autofocus />
            </div>

            <!-- Insurance Policy No. -->
            <div class="mt-4">
                <x-label for="Policy No." :value="__('Insurance Policy Number:')" hidden />

                <x-input id="policy_no" class="policy block mt-1 w-full" type="number" name="policy_no" :value="old('policy_no')" />
            </div>

            <!-- Specify -->
            <div class="mt-4">
                <x-label for="Specify" :value="__('Specify:')" />

                <x-input id="specify" class="policy block mt-1 w-full" type="text" name="specify" :value="old('specify')" />
            </div>

            <!-- Medical Condition -->
            <div class="mt-4">
                <x-label for="Medical_Condition" :value="__('Any underlying medical condition?')" />

                <select class="custom-select custom-select-lg mb-3" id="cond" onchange="descr(this)">
                    <option value="0" selected>Any underlying medical condition?</option>
                    <option value="yes">Yes</option>
                    <option value="no">No</option>
                </select>
            </div>

            <!-- Medical Condition Description -->
            <div class="mt-4">
                <x-label for="Medical_Description" :value="__('If yes which one?')" />

                <x-input id="Medical_Description" class="desc block mt-1 w-full" type="text" name="Medical_Description" :value="old('Medical_Description')" />
            </div>






            <div class="pagination flex items-center justify-end mt-4">

                <x-button type="submit" class="ml-4">
                    {{ __('Proceed') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>