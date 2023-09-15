@extends('layouts.master')
@section('heading')
    <h3 class="{{ session()->has('lang_code') ? (session()->get('lang_code') == 'ar' ? 'float-right' : '') : '' }}">
        {{ __('workers.workers') }}</h3>
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
                            <p> {{ __('workers.addbutton') }} </p>
                        </span>
                    </a>
                    <!-- The Modal -->
                    <div class="modal fade" id="addacademy">
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title">{{ __('workers.add') }}</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>

                                <!-- Modal body -->
                                <div class="modal-body">
                                    <div align="center">
                                        <img src="{{ asset('img/undraw_mobile_payments_re_7udl.svg') }}"
                                            style="width: 35%; height: 20%">

                                        <p style="padding-top: 3%">{{ __('workers.add') }}</p>
                                    </div>
                                    <br>
                                    <form action="{{ route('addworker') }}" method="POST">

                                        @csrf


                                        <div class="py-4">
                                            <label> {{ __('general.name') }}</label>
                                            <input type="text" name="name" class="form-control" placeholder="">
                                        </div>
                                        <div class="py-4">
                                            <label> {{ __('general.email') }}</label>
                                            <input type="email" name="email" class="form-control" placeholder="">
                                        </div>
                                        <div class="py-4">
                                            <label> {{ __('general.password') }}</label>
                                            <input type="password" name="password" class="form-control" placeholder="">
                                        </div>
                                        <div class="py-4">
                                            <label> {{ __('general.confirmpswd') }}</label>
                                            <input type="password" name="password_confirmation" class="form-control"
                                                placeholder="">
                                        </div>


                                        <div class="py-4">
                                            <label> {{ __('workers.salary') }}</label>
                                            <input type="number" name="salary" class="form-control" placeholder="">
                                        </div>
                                        <div class="py-4">
                                            <label> {{ __('workers.mission') }}</label>
                                            <input type="text" name="mission" class="form-control" placeholder="">
                                        </div>
                                        <div class="py-4">
                                            <label> {{ __('general.age') }}</label>
                                            <input type="number" name="age" class="form-control" placeholder="">
                                        </div>
                                        <div class="py-4">
                                            <label> {{ __('workers.joindate') }}</label>
                                            <input type="date" name="joindate" class="form-control" placeholder="">
                                        </div>


                                        <button class="btn btn-success text-light" type="submit">
                                            {{ __('buttons.add') }}</button>
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
                </div>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th> # </th>
                                <th> {{ __('general.name') }}</th>
                                <th> {{ __('general.email') }}</th>
                                <th> {{ __('workers.mission') }} </th>
                                <th> {{ __('workers.salary') }} </th>
                                <th> {{ __('workers.joindate') }} </th>
                                <th> {{ __('general.age') }} </th>
                                <th> {{ __('general.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($workers as $worker)
                                <tr>
                                    <td> {{ $worker->id }} </td>
                                    <td> {{ $worker->name }}</td>
                                    <td> {{ $worker->email }} </td>
                                    <td> {{ $worker->worker->mission }} </td>
                                    <td> {{ $worker->worker->salary }} DH </td>
                                    <td> {{ $worker->worker->joindate }} </td>
                                    <td> {{ $worker->worker->age }} </td>
                                    <td><a href="{{ route('editService', $worker->id) }}" class="btn btn-info btn-circle"
                                            data-toggle="modal" data-target="#edit{{ $worker->id }}"> <i
                                                class="fa fa-pen"></i></a>
                                        <!-- The Modal -->
                                        <div class="modal fade" id="edit{{ $worker->id }}">
                                            <div class="modal-dialog">
                                                <div class="modal-content">

                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">{{ __('workers.edit') }}</h4>
                                                        <button type="button" class="close"
                                                            data-dismiss="modal">&times;</button>
                                                    </div>

                                                    <!-- Modal body -->
                                                    <div class="modal-body">
                                                        <div align="center">
                                                            <img src="{{ asset('img/undraw_text_field_htlv.svg') }}"
                                                                style="width: 35%; height: 20%">

                                                            <p style="padding-top: 3%">{{ __('workers.edit') }}</p>
                                                        </div>
                                                        <br>
                                                        <form action="{{ route('editworker', $worker->worker->id) }}"
                                                            method="POST">
                                                            @method('PATCH')
                                                            @csrf
                                                            <div class="py-4">
                                                                <label> {{ __('general.name') }}</label>
                                                                <input type="text" name="name" class="form-control"
                                                                    placeholder="" value="{{ $worker->name }}">
                                                            </div>
                                                            <div class="py-4">
                                                                <label> {{ __('general.email') }}</label>
                                                                <input type="email" name="email" class="form-control"
                                                                    placeholder="" value="{{ $worker->email }}">
                                                            </div>
                                                            <div class="py-4">
                                                                <label> {{ __('general.password') }}</label>
                                                                <input type="password" name="password"
                                                                    class="form-control" placeholder="">
                                                            </div>
                                                            <div class="py-4">
                                                                <label> {{ __('general.confirmpswd') }}</label>
                                                                <input type="password" name="password_confirmation"
                                                                    class="form-control" placeholder="">
                                                            </div>
                                                            <div class="py-4">
                                                                <label> {{ __('workers.salary') }}</label>
                                                                <input type="text" name="salary" class="form-control"
                                                                    placeholder="" value="{{ $worker->worker->salary }}">
                                                            </div>
                                                            <div class="py-4">
                                                                <label> {{ __('workers.mission') }}</label>
                                                                <input type="text" name="mission" class="form-control"
                                                                    placeholder=""
                                                                    value="{{ $worker->worker->mission }}">
                                                            </div>
                                                            <div class="py-4">
                                                                <label> {{ __('general.age') }}</label>
                                                                <input type="number" name="age" class="form-control"
                                                                    placeholder="" value="{{ $worker->worker->age }}">
                                                            </div>
                                                            <div class="py-4">
                                                                <label> {{ __('workers.joindate') }}</label>
                                                                <input type="date" name="joindate"
                                                                    class="form-control" placeholder=""
                                                                    value="{{ $worker->worker->joindate }}">
                                                            </div>

                                                            <button class="btn btn-success text-light" type="submit">
                                                                {{ __('buttons.add') }}</button>
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
                                        <button type="button" class="btn btn-danger btn-circle" data-toggle="modal"
                                            data-target="#myModal{{ $worker->id }}">
                                            <i class="fas fa-trash"></i>
                                        </button>

                                        <!-- The Modal -->
                                        <div class="modal fade" id="myModal{{ $worker->id }}">
                                            <div class="modal-dialog">
                                                <div class="modal-content">

                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">{{ __('workers.delete') }}</h4>
                                                        <button type="button" class="close"
                                                            data-dismiss="modal">&times;</button>
                                                    </div>

                                                    <!-- Modal body -->
                                                    <div class="modal-body">
                                                        <div align="center">
                                                            <img src="{{ asset('img/undraw_throw_away_re_x60k (1).svg') }}"
                                                                style="width: 45%; height: 25%">

                                                            <p style="padding-top: 3%">{{ __('workers.deleteprompt') }}
                                                            </p>
                                                        </div>
                                                        <br>
                                                        <form action="{{ route('deleteworker', $worker->id) }}"
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
                                <h2> No workers to display </h2>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{ $workers->links() }}

            </div>
        </div>
    </div>
@endsection
