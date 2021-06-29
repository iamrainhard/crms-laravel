@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
            </div>
        </div>
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">User Profile</h1>
        </div>

        <div class="row p-2">
            <div class="col-md-5">
                <div class="card shadow mb-4">
                    <div class="card-body text-center">
                        <div class="rounded-circle mb-4 text-center">
                            @if(Auth::user()->gender === 'male')
                                <img src="/img/male.png" alt="" class="img-fluid w-50">
                            @else
                                <img src="/img/female.png" alt="" class="img-fluid w-50">
                            @endif
                        </div>
                        <h1 class="m-0 font-weight-bold text-primary">{{$user->firstName}} {{$user->sirName}}</h1>
                        <h5 class="m-0">{{$user->email}}</h5>
                        <h5 class="m-0">{{$user->mobile}}</h5>
                        <h5 class="m-0">
                            @if($user->role === 'admin')
                                Administrator
                            @elseif($user->role === 'manager')
                                HQ Manager
                            @elseif($user->role === 'pastor')
                                Senior Pastor
                            @else
                                Church Member
                            @endif
                        </h5>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">User Information</h6>
                    </div>

                    <div class="card-body">
                        <form action="/profile/{{$user->id}}" class="form" method="POST">
                            @method('PUT')
                            @csrf
                            <div class="modal-body">
                                <div class="form-group">
                                    <input value="{{$user->firstName }}" type="text"
                                           class="form-control form-control-user @error('firstName') is-invalid @enderror"
                                           name="firstName" autocomplete="firstName"
                                           autofocus placeholder="First Name" id="firstName">
                                    @error('firstName')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input value="{{ $user->sirName }}" type="text"
                                           class="form-control form-control-user @error('sirName') is-invalid @enderror"
                                           name="sirName" autocomplete="sirName"
                                           autofocus placeholder="Sir Name" id="sirName">
                                    @error('sirName')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <input value="{{$user->email}}" type="email"
                                           class="form-control form-control-user @error('email') is-invalid @enderror"
                                           id="email" name="email" autocomplete="email"
                                           autofocus aria-describedby="emailHelp" placeholder="Email Address">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <input value="{{$user->mobile}}" type="text"
                                           class="form-control form-control-user @error('mobile') is-invalid @enderror"
                                           id="mobile" name="mobile"
                                           autocomplete="mobile" autofocus aria-describedby="mobileHelp"
                                           placeholder="Phone Number">
                                    @error('mobile')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password"
                                               class="form-control form-control-user @error('password') is-invalid @enderror"
                                               name="password" autocomplete="current-password" id="password"
                                               placeholder="Password">

                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" id="password-confirm"
                                               class="form-control form-control-user"
                                               name="password_confirmation" autocomplete="new-password"
                                               placeholder="Confirm Password">
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center mt-2">
                                    <button class="btn btn-primary btn-user" type="submit">Update Profile</button>
                                </div>


                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
