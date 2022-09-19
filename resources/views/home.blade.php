@extends('layouts.master')
@section('heading')
    <h3> Home page </h3>
@endsection
@section('content')
<h2 > You are connected {{ Auth::user()->name }}</h2>
<form action="{{ route('logout')}}" method="POST">
    @csrf
    <input type="submit" class="btn btn-warning" value="Log out">
</form>
@endsection