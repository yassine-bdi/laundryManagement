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
                                        @livewire('add-command')

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
