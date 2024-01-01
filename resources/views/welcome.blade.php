@extends('layouts.app')

@section('content')
    <a href="{{ route('login-get') }}" class="btn btn-success m-2">Login Page</a>
    <a href="{{ route('import-reps-get') }}" class="btn btn-success m-2">Import Reps Excel File</a>
    <a href="{{ route('rep-home') }}" class="btn btn-success m-2">Rep Home Page</a>
    <a href="{{ route('fill-calender-get') }}" class="btn btn-success m-2">Fill Calender Weekly</a>
    <a href="{{ route('record-one-d-get') }}" class="btn btn-success m-2">Record Your Daily Progress</a>
    <hr style="border: 5px solid black;">
    <a href="{{ route('list-all-users') }}" class="btn btn-success m-2">List All Users</a>
    <a href="{{ route('create-user-get') }}" class="btn btn-success m-2">Create New user</a>
    <a href="{{ route('reset-user-get', 1) }}" class="btn btn-success m-2">Reset User Pasword</a>
    <a href="{{ route('retreive-rep-calender' , 1) }}" class="btn btn-success m-2">Retreive Calender Weekly</a>
    <hr><br>
@endsection
