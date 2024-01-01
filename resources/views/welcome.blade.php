@extends('layouts.app')

@section('content')
    <a href="{{ route('login-get') }}" class="btn btn-success m-2">Login Page</a>
    <a href="{{ route('import-reps-get') }}" class="btn btn-success m-2">Import Reps Excel File</a>
    <a href="{{ route('rep-home') }}" class="btn btn-success m-2">Rep Home Page</a>
    <a href="{{ route('fill-calender-get') }}" class="btn btn-success m-2">Fill Calender Weekly</a>
    <a href="{{ route('record-one-d-get') }}" class="btn btn-success m-2">Record Your Daily Progress</a>
    <hr style="border: 5px solid black;">
    <a href="#" class="btn btn-primary m-2">Fill Monthly Calender General Calender</a>

    <a href="{{ route('retreive-rep-calender') }}" class="btn btn-info m-2">Retreive Calender Weekly</a>
    <hr><br>

    <a href="#" class="btn btn-primary m-2">List All Users</a>
    {{-- Searching Users  --}}
    {{-- Tracking Progress For the Representative "Day By Day" and Disable Others --}}
    {{-- Making Register & reset & login [ NO NEED for Other Auth Links ] --}}
    <hr><br>

    <a href="{{ route('create-user-get') }}" class="btn btn-info m-2">Create New user</a>
    <a href="{{ route('reset-user-get', 1) }}" class="btn btn-info m-2">Reset User Pasword</a>
    <hr><br>

    <hr><br>
@endsection
