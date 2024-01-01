@extends('layouts.app')

@section('content')
    <a href="{{ route('login-get') }}" class="btn btn-success m-2">Login Page</a>
    <a href="{{ route('rep-home') }}" class="btn btn-success m-2">Rep Home Page</a>
    <hr style="border: 5px solid black;">
    <a href="{{ route('admin-home') }}" class="btn btn-success m-2">Admin Home Page </a>
    <hr><br>
@endsection
