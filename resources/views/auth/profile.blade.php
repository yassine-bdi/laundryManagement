@extends('layouts.master')
@section('heading')
    <h3 class="{{ session()->has('lang_code') ? (session()->get('lang_code') == 'ar' ? 'float-right' : '') : '' }}">
        {{ __('general.profile') }}</h3>
@endsection
@section('content')
    <div class="container">
        <div class="text-center">

        </div>
    </div>
@endsection
