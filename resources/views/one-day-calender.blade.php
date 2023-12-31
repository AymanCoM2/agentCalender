<meta name="csrf-token" content="{{ csrf_token() }}" />
@extends('layouts.app-one-d')
@php
@endphp
@section('content')
    <table class="table table-responsive">
        <thead>
            <tr>
                <th scope="col">Client Code</th>
                <th scope="col">Client Name</th>
                <th scope="col" colspan="">Day</th>
            </tr>
            <tr>
                <th></th>
                <th></th>
                <th>{{ $todaysDate }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($clientsDataArrray as $eachClient)
                <tr>
                    <td>{{ $eachClient->CardCode }}</td>
                    <td>{{ $eachClient->CardName }}</td>
                    <td>
                        @php
                            $matchingDateForClient = null;
                            foreach ($dailyProgressRecord as $singleProgressRecord) {
                                if ($singleProgressRecord->cardCode == $eachClient->CardCode) {
                                    $matchingDateForClient = $singleProgressRecord;
                                    break;
                                }
                            }
                        @endphp
                        <div class="inner_cell"
                            data-current-symbo="{{ $matchingDateForClient ? $matchingDateForClient->state : '_' }}"
                            data-task-date="{{ $todaysDate }}" data-task-month="{{ $currentMonthNumber }}"
                            data-card-code="{{ $eachClient->CardCode }}" data-rep-id="{{ Auth::user()->id }}">
                            {{ $matchingDateForClient ? $matchingDateForClient->state : '_' }}</div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
