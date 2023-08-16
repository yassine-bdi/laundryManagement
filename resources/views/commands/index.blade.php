@extends('layouts.master')
@section('heading')
  <h3 class="{{session()->has('lang_code')?(session()->get('lang_code')=='ar'?'text-center':''):''}}"> 
   {{ __('commands.commands')}}</h3> 
@endsection

    
