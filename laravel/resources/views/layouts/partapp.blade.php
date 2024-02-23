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
    <link href="{{ URL::to('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/izitoast@1.4.0/dist/css/iziToast.min.css">
    <script src="https://cdn.jsdelivr.net/npm/izitoast@1.4.0/dist/js/iziToast.min.js"></script>
    <script defer src="{{asset('js/app.js')}}"></script>
    <script src="{{URL::to('js/app.js')}}"></script>
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        @include('layouts.partnav')

        <!-- Page Heading -->
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>

        <!-- Page Content -->
        <main>
            {{ $slot }}

            <form method="POST" action="{{ route('check_in') }}">
                @csrf

                <!-- Your Courses -->
                @foreach ($course as $cours)
                <div>

                    <input type="hidden" name="cours" value="{{ $cours->id }}">
                    <p>{{ $cours->Course_Title }}</p>
                </div>
                @endforeach
                <x-button class="ml-4" type="submit">
                    {{ __('Check in') }}
                </x-button>
            </form>

            @if (session('status'))
            <script type="text/javascript">
                iziToast.show({
                    title: 'Hey',
                    message: "{{ session('status') }}",
                    position: 'topCenter'
                });
            </script>
            @endif
        </main>
    </div>
</body>

</html>