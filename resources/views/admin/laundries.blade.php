@extends('layouts.master')
@section('heading')
    <h3 class="{{ session()->has('lang_code') ? (session()->get('lang_code') == 'ar' ? 'text-center' : '') : '' }}">
        {{ __('laundries.laundries') }}</h3>
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

    <div class="row">
        <div class="col-sm-6 py-3">
            <a href="{{ route('addService') }}" class="btn btn-info btn-icon-split btn-sm " data-toggle="modal"
                data-target="#addacademy">
                <span class="icon text-white-40">
                    <i class="fa fa-plus"></i>
                </span>
                <span class="text">
                    <p> {{ __('laundries.addbutton') }} </p>
                </span>
            </a>
            <!-- The Modal -->
            <div class="modal fade" id="addacademy">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">{{ __('laundries.addbutton') }}</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">
                            <div align="center">
                                <img src="{{ asset('img/undraw_mobile_payments_re_7udl.svg') }}"
                                    style="width: 35%; height: 20%">

                                <p style="padding-top: 3%">{{ __('laundries.addbutton') }}</p>
                            </div>
                            <br>
                            <form action="{{ route('addlaundry') }}" method="POST" enctype="multipart/form-data">

                                @csrf
                                <div class="py-4">
                                    <label> Name </label>
                                    <input type="text" name="name" class="form-control"
                                        placeholder="{{ __('general.writehere') }}">
                                </div>
                                <div class="py-4">
                                    <label> Image </label>
                                    <input type="file" name="image" capture="environment" class="form-control"
                                        accept="image/*" placeholder="{{ __('general.writehere') }}">
                                </div>
                                <button class="btn btn-success text-light" type="submit">
                                    {{ __('buttons.add') }}</button>
                                &nbsp; <button class="btn btn-danger" data-dismiss="modal"> {{ __('buttons.cancel') }}
                                </button>
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
    <div class="card-columns">


        @forelse($laundries as $laundry)
            <div class="card shadow 2px 2px">
                <img src="{{ $laundry->photo ? asset('storage/' . $laundry->photo) : asset('img/No-Image.jpeg') }}"
                    width="100px" class="card-img-top">
                <div class="card-body" cellspacing="0">



                    <h5> {{ $laundry->name }}</h5>
                    <a href="{{ route('editService', $laundry->id) }}" class="btn btn-info " data-toggle="modal"
                        data-target="#edit{{ $laundry->id }}"> <i class="fa fa-pen"></i></a>
                    <!-- The Modal -->
                    <div class="modal fade" id="edit{{ $laundry->id }}">
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title">{{ __('laundries.edit') }}</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>

                                <!-- Modal body -->
                                <div class="modal-body">
                                    <div align="center">
                                        <img src="{{ asset('img/undraw_text_field_htlv.svg') }}"
                                            style="width: 35%; height: 20%">

                                        <p style="padding-top: 3%">{{ __('laundries.edit') }}</p>
                                    </div>
                                    <br>
                                    <form action="{{ route('editlaundries', $laundry->id) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @method('PATCH')
                                        @csrf
                                        <div class="py-4">
                                            <label> {{ __('general.name') }} </label>
                                            <input type="text" name="name" class="form-control"
                                                value="{{ $laundry->name }}" placeholder="entrer le nom d'académie">
                                        </div>
                                        <div class="py-4">
                                            <p> Current image : </p>
                                            <img class="px-3" src="{{ asset('storage/' . $laundry->photo) }}"
                                                width="120px">
                                            <label> {{ __('general.image') }} </label>

                                            <input type="file" name="image" class="form-control" accept="image/*"
                                                placeholder="{{ __('general.writehere') }}">
                                        </div>
                                        <button class="btn btn-success text-light" type="submit">
                                            {{ __('buttons.save') }}</button>
                                        &nbsp; <button class="btn btn-danger" data-dismiss="modal">
                                            {{ __('buttons.cancel') }} </button>
                                    </form>

                                </div>

                                <!-- Modal footer
                    <div class="modal-footer">
                      <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div> -->

                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-danger " data-toggle="modal"
                        data-target="#myModal{{ $laundry->id }}">
                        <i class="fas fa-trash"></i>
                    </button>

                    <!-- The Modal -->
                    <div class="modal fade" id="myModal{{ $laundry->id }}">
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title">{{ __('laundries.delete') }}</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>

                                <!-- Modal body -->
                                <div class="modal-body">
                                    <div align="center">
                                        <img src="{{ asset('img/undraw_throw_away_re_x60k (1).svg') }}"
                                            style="width: 45%; height: 25%">

                                        <p style="padding-top: 3%">{{ __('laundries.deleteprompt') }}</p>
                                    </div>
                                    <br>
                                    <form action="{{ route('deletelaundry', $laundry->id) }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button class="btn btn-danger text-light" type="submit">
                                            {{ __('buttons.yes') }}</button>
                                        &nbsp; <button class="btn btn-success" data-dismiss="modal">
                                            {{ __('buttons.no') }}</button>
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
            </div>



        @empty
            <h2> No Laundries to display </h2>
        @endforelse


    </div>


    {{ $laundries->links() }}


    <style>
        .card-columns {

            column-count: 6;
        }
    </style>

@endsection
