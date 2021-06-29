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
                        <form action="/churches/{{$church->id}}" class="form" method="POST">
                            @method('PATCH')
                            @csrf
                            <div class="form-group">
                                <select name="region_id" id="region_id"
                                        class="form-control form-control-user @error('region') is-invalid @enderror"
                                        autocomplete="region" autofocus>

                                    @foreach($regions as $region)
                                        @if($church->region_id === $region->id)
                                            <option value="{{$region->id}}" selected>{{$region->region}}</option>
                                        @else
                                            <option value="{{$region->id}}">{{$region->region}}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('region')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="text"
                                       class="form-control form-control-user @error('name') is-invalid @enderror"
                                       name="name" value="{{ $church->name }}" autocomplete="name"
                                       autofocus placeholder="Branch Name" id="name">
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="d-flex justify-content-center mt-2">
                                <button class="btn btn-primary btn-user" type="submit">Submit</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>


@endsection
