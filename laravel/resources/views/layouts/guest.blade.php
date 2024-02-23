<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'AccommodationRegistration') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Scripts -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script defer src="{{asset('js/app.js')}}"></script>
    <script>
        function text(x) {
            if (x == 0) {
                document.getElementById("prov").style.display = "none";
                document.getElementById("policy_no").style.display = "none";
                document.getElementById("specify").style.display = "none";
            }
            elseif(x == 1)
            document.getElementById("prov").style.display = "none";
            document.getElementById("policy_no").style.display = "none";
            document.getElementById("specify").style.display = "block";
            elseif(x == 2)
            document.getElementById("prov").style.display = "block";
            document.getElementById("policy_no").style.display = "block";
            document.getElementById("specify").style.display = "none";
        }
    </script>
</head>

<body>
    <div class="font-sans text-gray-900 antialiased">
        {{ $slot }}
    </div>
</body>

</html>