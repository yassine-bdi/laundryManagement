@extends('layouts.master')
@section('heading')
    <h3> Home page </h3>
@endsection
@section('content')
<h2 > You are connected {{ Auth::user()->name }}</h2>
<div class="container">
        <h5> new command </h5>          
         <form action="" method="POST">
            @csrf
        @foreach($items as $item)
        <div class="form-check" >
             <label class="form-check-label">  <input type="checkbox" name="item" class="form-check-input">{{$item->name}}  </label> 
            </div>
         @endforeach
         </form>
</div>
@endsection