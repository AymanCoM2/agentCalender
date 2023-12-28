@extends('layouts.app')

@section('content')
    <a href="#" class="btn btn-primary m-2">Fill Monthly Calender General Calender</a>
    <br>
    <a href="{{ route('fill-calender-get') }}" class="btn btn-info m-2">Fill Calender Weekly</a>
    <br>
    <a href="#" class="btn btn-primary m-2">Track your Progress </a>
    <br>
@endsection
