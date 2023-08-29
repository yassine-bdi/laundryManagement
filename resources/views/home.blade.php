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
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="container">
        <div class="card shadow mb-4 ">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col-sm-6 py-3">
                        <a href="" class="btn btn-info btn-icon-split btn-sm " data-toggle="modal"
                            data-target="#addacademy">
                            <span class="icon text-white-40">
                                <i class="fa fa-plus"></i>
                            </span>
                            <span class="text">
                                <p> {{ __('commands.add') }} </p>
                            </span>
                        </a>
                        <!-- The Modal -->
                        <div class="modal fade" id="addacademy">
                            <div class="modal-dialog">
                                <div class="modal-content">

                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title">{{ __('commands.add') }}</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>

                                    <!-- Modal body -->
                                    <div class="modal-body">
                                        <div align="center">
                                            <img src="{{ asset('img/undraw_mobile_payments_re_7udl.svg') }}"
                                                style="width: 35%; height: 20%">

                                            <p style="padding-top: 3%">{{ __('commands.add') }}</p>
                                        </div>
                                        <br>
                                        <p> choose a service </p>
                                        <form action="{{ route('addcommand') }}" method="POST">
                                            @csrf
                                            @foreach ($services as $service)
                                                <div class="form-check">
                                                    <label class="form-check-label"> <input type="radio" name="service"
                                                            class="form-check-input"
                                                            value="{{ $service->id }}">{{ $service->name }} </label>
                                                </div>
                                            @endforeach

                                            <p class="py-2"> choose an item </p>

                                            @csrf
                                            @foreach ($items as $item)
                                                <div class="form-check">
                                                    <label class="form-check-label"> <input type="checkbox" name="items[]"
                                                            class="form-check-input"
                                                            value="{{ $item->id }}">{{ $item->name }} </label>
                                                </div>
                                            @endforeach
                                            <div class="py-2">
                                                <input type="text" name="client" class="form-control"
                                                    placeholder="client's name.." value="">
                                            </div>
                                            <div class="py-2">
                                                <input type="text" name="delivery_address" class="form-control"
                                                    placeholder="delivery address.." value="null">
                                            </div>
                                            <div class="py-2">
                                                <input type="text" name="note" class="form-control"
                                                    placeholder="write a note.." value="null">
                                            </div>

                                            <div class="py-2">
                                                <input type="submit" class="btn btn-success" value="Send">
                                            </div>

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
            </div>
        </div>
    </div>
@endsection
