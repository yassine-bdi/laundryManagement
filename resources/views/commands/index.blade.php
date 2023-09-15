@extends('layouts.master')
@section('heading')
    <h3 class="{{ session()->has('lang_code') ? (session()->get('lang_code') == 'ar' ? 'text-center' : '') : '' }}">
        {{ __('commands.commands') }}</h3>
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
                                            <label class="form-label"> Client's name </label>
                                            <input type="text" name="client" class="form-control"
                                                placeholder="client's name.." value="">
                                        </div>
                                        <div class="py-2">
                                            <label class="form-label"> Delivery address </label>
                                            <input type="text" name="delivery_address" class="form-control"
                                                placeholder="delivery address.." value=" ">
                                        </div>
                                        <div class="py-2">
                                            <label class="form-label"> Note </label>
                                            <input type="text" name="note" class="form-control"
                                                placeholder="write a note.." value=" ">
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
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th> # </th>
                                <th> {{ __('services.service') }} </th>
                                <th> {{ __('laundries.laundry') }} </th>
                                <th> {{ __('prices.totalprice') }} </th>
                                <th> {{ __('general.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($commands as $command)
                                <tr>
                                    <td> {{ $command->id }} </td>
                                    <td> {{ $command->service_id }}</td>
                                    <td> </td>
                                    <td> {{ $command->total_price }} DH </td>
                                    <td>
                                        <button type="button" class="btn btn-danger btn-circle" data-toggle="modal"
                                            data-target="#myModal{{ $command->id }}">
                                            <i class="fas fa-trash"></i>
                                        </button>

                                        <!-- The Modal -->
                                        <div class="modal fade" id="myModal{{ $command->id }}">
                                            <div class="modal-dialog">
                                                <div class="modal-content">

                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">{{ __('commands.delete') }}</h4>
                                                        <button type="button" class="close"
                                                            data-dismiss="modal">&times;</button>
                                                    </div>

                                                    <!-- Modal body -->
                                                    <div class="modal-body">
                                                        <div align="center">
                                                            <img src="{{ asset('img/undraw_throw_away_re_x60k (1).svg') }}"
                                                                style="width: 45%; height: 25%">

                                                            <p style="padding-top: 3%">{{ __('commands.delete') }}
                                                            </p>
                                                        </div>
                                                        <br>
                                                        <form action="{{ route('deletecommand', $command->id) }}"
                                                            method="POST">
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
                                </tr>
                            @empty
                                <h2> No commands to display </h2>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{ $commands->links() }}

            </div>
        </div>
    </div>
@endsection
