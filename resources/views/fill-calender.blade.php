<meta name="csrf-token" content="{{ csrf_token() }}" />
@extends('layouts.app')
@section('content')
    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
        @foreach ($weeksArray as $weekNumber => $daysOfWeek)
            <li class="nav-item" role="presentation">
                <button class="nav-link {{ $weekNumber == 'week_1' ? 'active' : '' }}" id="tab-{{ $weekNumber }}"
                    data-bs-toggle="pill" data-bs-target="#{{ $weekNumber }}" type="button" role="tab">
                    {{ $weekNumber }}
                </button>
            </li>
        @endforeach
    </ul>
    <div class="tab-content" id="pills-tabContent">
        @foreach ($weeksArray as $weekNumber => $daysOfWeekArray)
            <div class="tab-pane {{ $weekNumber == 'week_1' ? 'show active' : '' }} fade" id="{{ $weekNumber }}"
                role="tabpanel" tabindex="0">
                <table class="table  table-striped overflow-scroll" id="myTable">
                    <thead>
                        <tr>
                            <th scope="col">Client Code</th>
                            <th scope="col">Client Name</th>
                            <th scope="col">Company</th>
                            <th scope="col" colspan="7">Month : {{ 'JAN_TEST' }}</th>
                        </tr>
                        <tr>
                            <th class="thick-border"></th>
                            <th></th>
                            <th></th>
                            @foreach ($daysOfWeekArray as $dateOfDay => $dayName)
                                <th>{{ $dayName }}</th>
                            @endforeach
                        </tr>
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            @foreach ($daysOfWeekArray as $dateOfDay => $dayName)
                                <th>{{ \Carbon\Carbon::parse($dateOfDay)->format('d') }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($clientsDataArrray as $eachClient)
                            <tr>
                                <td>{{ $eachClient->CardCode }}</td>
                                <td> {{ $eachClient->CardName }} </td>
                                <td> {{ $eachClient->COMP }} </td>
                                @foreach ($daysOfWeekArray as $eachDayDate => $eachDateName)
                                    <td>
                                        @php
                                            $flag = false;
                                            foreach ($matchingMonthPlan as $dummyMatchPlan) {
                                                if ($dummyMatchPlan->date == $eachDayDate && $dummyMatchPlan->cardCode == $eachClient->CardCode && $dummyMatchPlan->company == $eachClient->COMP) {
                                                    $flag = true;
                                                    break;
                                                }
                                            }
                                        @endphp
                                        <div class="inner_cell"
                                            data-current-symbo="{{ $flag ? $dummyMatchPlan->state : '_' }}"
                                            data-task-date="{{ $eachDayDate }}"
                                            data-task-month="{{ $currentMonthNumber }}"
                                            data-card-code="{{ $eachClient->CardCode }}"
                                            data-company-name="{{ $eachClient->COMP }}"
                                            data-rep-id="{{ Auth::user()->id }}">
                                            {{ $flag ? $dummyMatchPlan->state : '_' }}</div>
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endforeach
    </div>
@endsection
