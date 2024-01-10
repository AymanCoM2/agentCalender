@extends('layouts.app-retreive-cust')
@section('content')
    <div class="container">
        @if (session()->has('msg'))
            <div class="alert alert-success">
                {{ session('msg') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            @foreach ($weeksArray as $weekNumber => $daysOfWeek)
                <li class="nav-item active" role="presentation">
                    <button class="nav-link {{ $weekNumber == 'week_1' ? 'active' : '' }} " id="tab-{{ $weekNumber }}"
                        data-bs-toggle="pill" data-bs-target="#{{ $weekNumber }}" type="button" role="tab">
                        {{ $weekNumber }}
                    </button>
                </li>
            @endforeach

            <li class="nav-item" role="presentation">
                <a href="{{ route('approve-rep-plan', $repId) }}" class="btn btn-warning rounded-pill px-3 py-2 mx-3">✅</a>
            </li>
        </ul>
        <div class="tab-content" id="pills-tabContent">
            @foreach ($weeksArray as $weekNumber => $daysOfWeekArray)
                <div class="tab-pane {{ $weekNumber == 'week_1' ? 'show active' : '' }}  fade" id="{{ $weekNumber }}"
                    role="tabpanel" tabindex="0">
                    <table class="table table-responsive table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Client Name</th>
                                <th scope="col" colspan="7">Month</th>
                            </tr>
                            <tr>
                                <th></th>
                                <!-- Repeat for the rest of the days -->
                                @foreach ($daysOfWeekArray as $dateOfDay => $dayName)
                                    <th>{{ $dayName }}</th>
                                @endforeach
                            </tr>
                            <tr>
                                <th></th>
                                @foreach ($daysOfWeekArray as $dateOfDay => $dayName)
                                    <th>{{ \Carbon\Carbon::parse($dateOfDay)->format('d') }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($clientsDataArrray as $eachClient)
                                <tr>
                                    <td>{{ $eachClient->client_name }}</td>
                                    <!-- Repeat for the rest of the days -->
                                    @foreach ($daysOfWeekArray as $eachDayDate => $eachDateName)
                                        <td>
                                            @php
                                                $flag = false;
                                                foreach ($matchingDummies as $dummy) {
                                                    if ($dummy->date == $eachDayDate && $dummy->cardCode == $eachClient->id) {
                                                        $flag = true;
                                                        break;
                                                    }
                                                }
                                            @endphp
                                            <div class="inner_cell" data-current-symbo="{{ $flag ? $dummy->state : '_' }}"
                                                data-task-date="{{ $eachDayDate }}" data-task-month="12"
                                                data-card-code="{{ $eachClient->CardCode }}"
                                                data-rep-id="{{ Auth::user()->id }}">
                                                {{ $flag ? $dummy->state : '_' }}
                                            </div>
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endforeach
        </div>
    </div>
    {{-- {{ $clientsDataArrray->links() }} --}}
@endsection
