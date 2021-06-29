@extends('layouts.master')

@section('content')
    <div class="container">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Branch Registration</h1>
        </div>
        <div class="row">
            <div class="col-8">
                <div class="card shadow">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Branch Registration Form</h6>
                    </div>
                    <div class="card-body">
                        <form action="/churches" class="form" method="POST">
                            @csrf
                            <div class="modal-body">
                                <div class="form-group">

                                    <div class="form-group">
                                        <select name="region" id="region_id"
                                                class="form-control form-control-user @error('region') is-invalid @enderror"
                                                autocomplete="region" autofocus>
                                            <option value="" selected disabled>Select the Church Region</option>
                                            @foreach($regions as $region)
                                                <option value="{{$region->id}}">{{$region->region}}</option>
                                            @endforeach
                                        </select>
                                        @error('region')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                    <input type="text"
                                           class="form-control form-control-user @error('name') is-invalid @enderror"
                                           name="name" value="{{ old('name') }}" autocomplete="name"
                                           autofocus placeholder="Branch Name" id="name">
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="d-flex justify-content-center mt-2">
                                    <button class="btn btn-primary btn-user" type="submit">Register</button>
                                </div>


                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>


@endsection
