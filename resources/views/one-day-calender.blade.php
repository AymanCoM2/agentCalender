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
                <th scope="col">Company</th>
                <th scope="col" colspan="">Day</th>
            </tr>
            <tr>
                <th></th>
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
                    <td>{{ $eachClient->COMP }}</td>
                    <td>
                        @php
                            $matchingDateForClient = null;
                            foreach ($dailyProgressRecord as $singleProgressRecord) {
                                if ($singleProgressRecord->cardCode == $eachClient->CardCode && $singleProgressRecord->company == $eachClient->COMP) {
                                    $matchingDateForClient = $singleProgressRecord;
                                    break;
                                }
                            }
                        @endphp
                        <div class="inner_cell {{ in_array($eachClient->CardCode, $xedClients) ? 'xed' : 'oed' }}"
                            data-current-symbo="{{ $matchingDateForClient ? $matchingDateForClient->state : '_' }}"
                            data-task-date="{{ $todaysDate }}" data-task-month="{{ $currentMonthNumber }}"
                            data-card-code="{{ $eachClient->CardCode }}" data-company-name="{{ $eachClient->COMP }}"
                            data-rep-id="{{ Auth::user()->id }}">
                            {{ $matchingDateForClient ? $matchingDateForClient->state : '_' }}</div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
