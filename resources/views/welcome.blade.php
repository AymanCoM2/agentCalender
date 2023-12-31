@extends('layouts.app')

@section('content')
    <a href="#" class="btn btn-primary m-2">Fill Monthly Calender General Calender</a>
    <hr><br>
    <a href="{{ route('fill-calender-get') }}" class="btn btn-info m-2">Fill Calender Weekly</a>
    <a href="{{ route('retreive-rep-calender') }}" class="btn btn-info m-2">Retreive Calender Weekly</a>
    <hr><br>
    <a href="#" class="btn btn-primary m-2">Track Your Progress</a>
    <a href="#" class="btn btn-primary m-2">List All Users</a>
    {{-- Searching Users  --}}
    {{-- Tracking Progress For the Representative "Day By Day" and Disable Others --}}
    {{-- Making Register & reset & login [ NO NEED for Other Auth Links ] --}}
    <hr><br>
    <a href="{{ route('login-get') }}" class="btn btn-info m-2">Login Page</a>
    <a href="{{ route('create-user-get') }}" class="btn btn-info m-2">Create New user</a>
    <a href="{{ route('reset-user-get', 1) }}" class="btn btn-info m-2">Reset User Pasword</a>
    <hr><br>
@endsection
