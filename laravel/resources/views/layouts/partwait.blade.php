@inject('part', 'App\Http\Controllers\Participant')
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
        @include('layouts.partnav', ['checkins' => $checkins])

        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Wait area') }}
            </h2>
        </x-slot>

        @if ($part->checkinsCount()->count() == 1)
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        After session is over, kindly check out.
                    </div>
                </div>
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-header pb-0">
                Your Current Checkins
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center justify-content-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Full Names</th>
                                <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Course</th>
                                <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Check in by</th>
                                <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Check in Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($checkins as $checkin)
                            <tr>
                                <td>
                                    @if ($participant = $checkin->participants->first())
                                    <p class="text-xs px-3 font-weight-bold mb-0">{{ $participant->Full_Names }}</p>
                                    @else
                                    <p class="text-xs px-3 font-weight-bold mb-0">No participant found</p>
                                    @endif
                                </td>
                                <td>
                                    @if ($course = $checkin->courses->first())
                                    <p class="text-xs px-3 font-weight-bold mb-0">{{ $course->Course_Title }}</p>
                                    @else
                                    <p class="text-xs px-3 font-weight-bold mb-0">No course found</p>
                                    @endif
                                </td>

                                <td>
                                    <p class="text-xs px-3 font-weight-bold mb-0">{{ $checkin->admins->Full_Names ?? 'Not checked in by the facilitator'}}</p>
                                </td>

                                <td>
                                    <p class="text-xs px-3 font-weight-bold mb-0">{{$checkin->Check_in}}</p>
                                </td>

                                <td class="align-middle text-center">
                                    <form method="POST" action="{{ URL::to('participant/dashboard/Checkout/'.$checkin->id) }}">
                                        @csrf
                                        @method('PUT')
                                        <x-button class="ml-3">
                                            {{ __('Check out') }}
                                        </x-button>
                                    </form>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
        @elseif ($part->checkinsCount()->count() > 1)
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        After session is over, kindly check out.
                    </div>
                </div>
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-header pb-0">
                Your Current Checkins
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center justify-content-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Full Names</th>
                                <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Course</th>
                                <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Check in by</th>
                                <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Check in Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($checkins as $checkin)
                            <tr>
                                <td>
                                    @if ($participant = $checkin->participants->first())
                                    <p class="text-xs px-3 font-weight-bold mb-0">{{ $participant->Full_Names }}</p>
                                    @else
                                    <p class="text-xs px-3 font-weight-bold mb-0">No participant found</p>
                                    @endif
                                </td>
                                <td>
                                    @if ($course = $checkin->courses->first())
                                    <p class="text-xs px-3 font-weight-bold mb-0">{{ $course->Course_Title }}</p>
                                    @else
                                    <p class="text-xs px-3 font-weight-bold mb-0">No course found</p>
                                    @endif
                                </td>
                                <td>
                                    <p class="text-xs px-3 font-weight-bold mb-0">{{$checkin->Check_in}}</p>
                                </td>

                                <td>
                                    @if ($admin = $checkin->admins->first())
                                    <p class="text-xs px-3 font-weight-bold mb-0">{{ $admin->Full_Names }}</p>
                                    @else
                                    <p class="text-xs px-3 font-weight-bold mb-0">Not checked in yet.</p>
                                    @endif
                                </td>

                                <td class="align-middle text-center">
                                <form method="POST" action="{{ URL::to('participant/dashboard/Checkout/'.$checkin->id) }}">
                                        @csrf
                                        @method('PUT')
                                        <x-button class="ml-3">
                                            {{ __('Check out') }}
                                        </x-button>
                                    </form>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
        @else
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        Kindly wait to be checked in...
                    </div>
                </div>
            </div>
        </div>
        @endif


        @if (session('status'))
        <script type="text/javascript">
            iziToast.show({
                title: 'Hey',
                message: "{{ session('status') }}",
                position: 'topCenter'
            });
        </script>
        @endif

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </div>
</body>

</html>