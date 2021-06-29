@extends('layouts.master')

@section('content')
    <div class="container">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Member Registration</h1>
        </div>
        <div class="row">
            <div class="col-8">
                <div class="card shadow">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Member Edit Form</h6>
                    </div>
                    <div class="card-body">
                        <form action="/members/{{$member->id}}" class="form" method="POST">
                            @method('PUT')
                            @csrf
                            <div class="modal-body">
                                <div class="form-group">
                                    <input value="{{$member->firstName }}" type="text"
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
                                    <input value="{{ $member->sirName }}" type="text"
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
                                    <input value="{{$member->email}}" type="email"
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
                                    <input value="{{$member->mobile}}" type="text"
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
                                <div class="form-group">
                                    <select name="gender" id="gender"
                                            class="form-control form-control-user @error('gender') is-invalid @enderror"
                                            autocomplete="gender" autofocus>
                                        @if($member->gender === 'male')
                                            <option selected value="male">Male</option>
                                            <option value="female">Female</option>
                                        @else
                                            <option selected value="female">Female</option>
                                            <option value="male">Male</option>
                                        @endif
                                    </select>
                                    @error('gender')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <select name="role" id="role"
                                            class="form-control form-control-user @error('role') is-invalid @enderror"
                                            autocomplete="role" autofocus>
                                        <option value="elder">Church Elder</option>
                                        <option value="member" selected>Church Member</option>
                                    </select>
                                    @error('role')
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
                                    <button class="btn btn-primary btn-user" type="submit">Submit</button>
                                </div>


                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>


@endsection
