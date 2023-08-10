@extends('layouts.master')
@section('heading')
  <h3 class="{{session()->has('lang_code')?(session()->get('lang_code')=='ar'?'float-right':''):''}}"> 
   {{ __('prices.prices')}}</h3> 
@endsection
@section('content')
@if (session('statut'))
<div class="alert alert-success alert-dismissible" role="alert">
    {{ session('statut') }}
</div>
@endif
@if (session('error'))
<div class="alert alert-danger alert-dismissible" role="alert">
    {{ session('error') }}
</div>
@endif
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
 
    <br><br>  
<div class="card shadow mb-4 ">
    <div class="card-header py-3">
        <div class="row">
            <div class="col-sm-6 py-3">
        <a href="" class="btn btn-info btn-icon-split btn-sm " data-toggle="modal" data-target="#addacademy"> 
            <span class="icon text-white-40">
                <i class="fa fa-plus"></i>
            </span>
            <span class="text">
                <p> {{__('prices.addbutton')}} </p>
            </span>
        </a>
          <!-- The Modal -->
          <div class="modal fade" id="addacademy">
            <div class="modal-dialog">
              <div class="modal-content">
          
                <!-- Modal Header -->
                <div class="modal-header">
                  <h4 class="modal-title">{{ __('prices.add')}}</h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
          
                <!-- Modal body -->
                <div class="modal-body">
                  <div align="center">
                  <img src="{{ asset('img/undraw_mobile_payments_re_7udl.svg')}}" style="width: 35%; height: 20%" > 
                  
                  <p style="padding-top: 3%">{{ __('prices.add')}}</p>
                  </div>
                  <br>  <form action="{{route('addprice')}}" method="POST">
                    
                    @csrf 
                    <div class="py-4">
                        <label> {{__('laundries.laundries')}} </label>
                        <select name="laundry_id" class="form-control">
                            @foreach($laundries as $laundry) 
                               <option value="{{$laundry->id}}"> {{$laundry->name}} </option>
                            @endforeach 
                        </select>
                        </div>  
                    <div class="py-4">
                        <label> {{__('services.service')}} </label>
                        <select name="service_id" class="form-control">
                            @foreach($services as $service) 
                               <option value="{{$service->id}}"> {{$service->name}} </option>
                            @endforeach 
                        </select>
                        </div> 
                    <div class="py-4">
                    <input type="number" name="price" class="form-control" placeholder="{{ __('prices.add')}}">
                    </div> 
                  
                    
                    <button class="btn btn-success text-light"  type="submit" > 
                    {{ __('buttons.add')}}</button>
                    &nbsp;  <button class="btn btn-danger" data-dismiss="modal"> {{ __('buttons.cancel')}} </button> 
                </form>
                
                </div>
          
                <!-- Modal footer
                <div class="modal-footer">
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div> -->
          
              </div>
            </div>
          </div>
            </div>
        <div class="col-sm-6">
            <form action="" method="POST" class="form-inline">
                @csrf
                <label> Sort by</label> 
                &nbsp; 
                <select class="form-control " style="width:50%" name="sortby">
                    <option value="id"> ID </option>
                    <option value="nom"> nom </option>
                </select>
               &nbsp;
                <input type="submit" class="btn btn-success " value="Trier">
            </form>
        </div>       
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th> # </th>
                        <th> {{__('services.service')}} </th>
                        <th> {{__('laundries.laundry')}} </th>
                        <th> {{ __('prices.prices')}} </th>
                        <th> {{ __('general.actions')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($prices as $price) 
                    <tr> 
                        <td> {{$price->id}} </td>
                        <td> {{ $price->service->name }}</td>
                        <td> {{ $price->laundry->name}} </td>
                        <td> {{$price->price}} DH </td>
                        <td><a href="{{ route('editService',$price->id)}}" class="btn btn-info btn-circle" data-toggle="modal" data-target="#edit{{$price->id}}"> <i class="fa fa-pen"></i></a> 
                                    <!-- The Modal -->
          <div class="modal fade" id="edit{{$price->id}}">
            <div class="modal-dialog">
              <div class="modal-content">
          
                <!-- Modal Header -->
                <div class="modal-header">
                  <h4 class="modal-title">{{ __('prices.edit')}}</h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
          
                <!-- Modal body -->
                <div class="modal-body">
                  <div align="center">
                  <img src="{{ asset('img/undraw_text_field_htlv.svg')}}" style="width: 35%; height: 20%" > 
                  
                  <p style="padding-top: 3%">{{ __('prices.edit')}}</p>
                  </div>
                  <br>  <form action="{{route('editprice',$price->id)}}" method="POST">
                    @method('PATCH')
                    @csrf
                    <div class="py-4">
                      <label> {{__('laundries.laundries')}} </label>
                      <select name="laundry" class="form-control">
                          @foreach($laundries as $laundry) 
                             
                             <option value="{{$laundry->id}}" {{$price->laundry->id == $laundry->id ? 'selected' : ''}}> {{$laundry->name}} </option>
                          @endforeach 
                      </select>
                      </div>  
                  <div class="py-4">
                      <label> {{__('services.service')}} </label>
                      <select name="service" class="form-control">
                          @foreach($services as $service) 
                             <option value="{{$service->id}}" {{$price->service->id == $service->id ? 'selected' : ''}}> {{$service->name}} </option>
                          @endforeach 
                      </select>
                      </div> 
                  <div class="py-4">
                  <input type="number" name="price" class="form-control" placeholder="{{$price->price}}">
                  </div> 
                
                  
                    <button class="btn btn-success text-light"  type="submit" > 
                    {{ __('buttons.save')}}</button>
                    &nbsp;  <button class="btn btn-danger" data-dismiss="modal"> {{ __('buttons.cancel')}} </button> 
                </form>
                
                </div>
          
                <!-- Modal footer
                <div class="modal-footer">
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div> -->
          
              </div>
            </div>
          </div>
                            <button type="button" class="btn btn-danger btn-circle" data-toggle="modal" data-target="#myModal{{$price->id}}">
                                <i class="fas fa-trash"></i>
                              </button>
                              
                              <!-- The Modal -->
                              <div class="modal fade" id="myModal{{$price->id}}">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                              
                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                      <h4 class="modal-title">{{ __('prices.delete')}}</h4>
                                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                              
                                    <!-- Modal body -->
                                    <div class="modal-body">
                                      <div align="center">
                                      <img src="{{ asset('img/undraw_throw_away_re_x60k (1).svg')}}" style="width: 45%; height: 25%" > 
                                      
                                      <p style="padding-top: 3%">{{ __('prices.deleteprompt')}}</p>
                                      </div>
                                      <br>  <form action="{{route('deleteprice',$price->id)}}" method="POST">
                                        @method("DELETE")
                                        @csrf
                                        <button class="btn btn-danger text-light"  type="submit" > 
                                        {{ __('buttons.yes')}}</button>
                                        &nbsp;  <button class="btn btn-success" data-dismiss="modal"> {{ __('buttons.no')}}</button> 
                                    </form>
                                    
                                    </div>
                              
                                    <!-- Modal footer
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                    </div> -->
                              
                                  </div>
                                </div>
                              </div>
                    </tr>
                    @empty 
                      <h2> No Prices to display </h2>
                    @endforelse 
                </tbody>
            </table>
        </div>
      
      {{$prices->links()}}
    
    </div>
</div>
</div>
@endsection 