@extends('layouts.master')
@section('heading')
    <h3> Dashboard </h3>
@endsection
@section('content')
@if (session('statut'))
<div class="alert alert-success alert-dismissible" role="alert">
    {{ session('statut') }}
</div>
@endif
<div class="container">
        <h3> new command </h3>  
        <p> choose a service </p>        
         <form action="{{route('addcommand')}}" method="POST">
            @csrf
        @foreach($services as $service)
        <div class="form-check" >
             <label class="form-check-label">  <input type="radio" name="service" class="form-check-input" value="{{$service->id}}">{{$service->name}}  </label> 
            </div>
         @endforeach
         
         <p class="py-2"> choose an item </p>
          
            @csrf
        @foreach($items as $item)
        <div class="form-check" >
             <label class="form-check-label">  <input type="checkbox" name="items[]" class="form-check-input" value="{{$item->id}}">{{$item->name}}  </label> 
            </div>
         @endforeach
                    <div class="py-2">
            <input type="text" name="client" class="form-control" placeholder="client's name..">
          </div>
          <div class="py-2">
            <input type="text" name="delivery_address" class="form-control" placeholder="delivery address..">
          </div>
          <div class="py-2">
            <input type="text" name="note" class="form-control" placeholder="write a note..">
          </div>

          <div class="py-2">
            <input type="submit" class="btn btn-success" value="Send">
          </div>

         </form>

</div>
@endsection