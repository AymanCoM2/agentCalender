<meta name="csrf-token" content="{{ csrf_token() }}" />
@extends('layouts.app')
@php
    // In Case you Need to Add Something
    // Get Todays Date and see In Which Rate it is "" > For Progres Not Here
    //
@endphp
@section('content')
    {{-- Put here Hidden Input For the Rep_ID  --}}
    <div class="container">
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            @foreach ($weeksArray as $weekNumber => $daysOfWeek)
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="tab-{{ $weekNumber }}" data-bs-toggle="pill"
                        data-bs-target="#{{ $weekNumber }}" type="button" role="tab">
                        {{ $weekNumber }}
                    </button>
                </li>
            @endforeach
        </ul>
        <div class="tab-content" id="pills-tabContent">
            @foreach ($weeksArray as $weekNumber => $daysOfWeekArray)
                <div class="tab-pane fade" id="{{ $weekNumber }}" role="tabpanel" tabindex="0">
                    <table class="table table-responsive">
                        <thead>
                            <tr>
                                <th scope="col">Client Code</th>
                                <th scope="col">Client Name</th>
                                <th scope="col" colspan="7">Month</th>
                            </tr>
                            <tr>
                                <th></th>
                                <th></th>
                                <!-- Repeat for the rest of the days -->
                                @foreach ($daysOfWeekArray as $dateOfDay => $dayName)
                                    <th>{{ $dayName }}</th>
                                @endforeach
                            </tr>
                            <tr>
                                <th></th>
                                <th></th>
                                @foreach ($daysOfWeekArray as $dateOfDay => $dayName)
                                    <th>{{ $dateOfDay }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($clientsDataArrray as $eachClient)
                                <tr>
                                    <td>{{ $eachClient->CardCode }}</td>
                                    <td>{{ $eachClient->CardName }}</td>
                                    <!-- Repeat for the rest of the days -->
                                    @foreach ($daysOfWeekArray as $eachDayDate => $eachDateName)
                                        <td>
                                            @php
                                                $flag = false;
                                                foreach ($matchingDummies as $dummy) {
                                                    if ($dummy->date == $eachDayDate && $dummy->cardCode == $eachClient->CardCode) {
                                                        $flag = true;
                                                        break;
                                                    }
                                                }
                                            @endphp
                                            <div class="inner_cell" data-current-symbo="{{ $flag ? $dummy->state : '_' }}"
                                                data-task-date="{{ $eachDayDate }}" data-task-month="12"
                                                data-card-code="{{ $eachClient->CardCode }}" data-rep-id="777">
                                                {{ $flag ? $dummy->state : '_' }}</div>
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
@endsection
