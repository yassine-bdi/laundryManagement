@extends('layouts.master')
@section('heading')
    <h3> Home page </h3>
@endsection
@section('content')
<h2 > You are connected {{ Auth::user()->name }}</h2>

@endsection