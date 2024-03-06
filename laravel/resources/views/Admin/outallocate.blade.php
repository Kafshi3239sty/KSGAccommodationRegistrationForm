@inject('admin', 'App\Http\Controllers\Admin')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Check Outs') }}
        </h2>
    </x-slot>

    @if ($admin->checkoutsCount()->count() == 1)
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    You have {{ $admin->checkoutsCount()->count() ?? 0 }} checked out participant at the moment.
                </div>
            </div>
        </div>
    </div>
    <div class="card mb-4">
        <div class="card-header pb-0">
            Checked out Participants
        </div>
        <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-0">
                <table class="table align-items-center justify-content-center mb-0">
                    <thead>
                        <tr>
                            <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Full Names</th>
                            <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Course</th>
                            <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Check out Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($checkouts as $checkout)
                        <tr>
                            <td>
                                @if ($participant = $checkout->participants->first())
                                <p class="text-xs px-3 font-weight-bold mb-0">{{ $participant->Full_Names }}</p>
                                @else
                                <p class="text-xs px-3 font-weight-bold mb-0">No participant found</p>
                                @endif
                            </td>
                            <td>
                                @if ($course = $checkout->courses->first())
                                <p class="text-xs px-3 font-weight-bold mb-0">{{ $course->Course_Title }}</p>
                                @else
                                <p class="text-xs px-3 font-weight-bold mb-0">No course found</p>
                                @endif
                            </td>
                            <td>
                                <p class="text-xs px-3 font-weight-bold mb-0">{{$checkout->Check_out}}</p>
                            </td>

                            <td class="align-middle text-center">
                                <form method="POST" action="{{ URL::to('admin/confirmCheckout/'.$checkout->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <x-button class="ml-3">
                                        {{ __('Check out') }}
                                    </x-button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>
    @elseif ($admin->checkoutsCount()->count() > 1)
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    You have {{ $admin->checkoutsCount()->count() ?? 0 }} checked out participants at the moment.
                </div>
            </div>
        </div>
    </div>
    <div class="card mb-4">
        <div class="card-header pb-0">
            Checked out Participants
        </div>
        <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-0">
                <table class="table align-items-center justify-content-center mb-0">
                    <thead>
                        <tr>
                            <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Full Names</th>
                            <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Course</th>
                            <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Check out Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($checkouts as $checkout)
                        <tr>
                            <td>
                                @if ($participant = $checkout->participants->first())
                                <p class="text-xs px-3 font-weight-bold mb-0">{{ $participant->Full_Names }}</p>
                                @else
                                <p class="text-xs px-3 font-weight-bold mb-0">No participant found</p>
                                @endif
                            </td>
                            <td>
                                @if ($course = $checkout->courses->first())
                                <p class="text-xs px-3 font-weight-bold mb-0">{{ $course->Course_Title }}</p>
                                @else
                                <p class="text-xs px-3 font-weight-bold mb-0">No course found</p>
                                @endif
                            </td>
                            <td>
                                <p class="text-xs px-3 font-weight-bold mb-0">{{$checkout->Check_out}}</p>
                            </td>

                            <td class="align-middle text-center">
                                <form method="POST" action="{{ URL::to('admin/confirmCheckout/'.$checkout->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <x-button class="ml-3">
                                        {{ __('Check out') }}
                                    </x-button>
                                </form>
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
                    You have no checked out participants at the moment.
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
</x-app-layout>