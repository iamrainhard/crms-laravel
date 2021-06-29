@extends('layouts.master')

@section('content')
    <div class="container">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Finance Edit</h1>
        </div>
        <div class="row">
            <div class="col-8">
                <div class="card shadow">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Finance Edit Form</h6>
                    </div>
                    <div class="card-body">
                        <form action="/finances/{{$finance->id}}" class="form" method="POST">
                            @method('PATCH')
                            @csrf

                            <div class="form-group">
                                <input type="text"
                                       class="form-control form-control-user @error('type') is-invalid @enderror"
                                       id="type" name="type" value="{{ $finance->type}}" required
                                       autocomplete="type"
                                       autofocus aria-describedby="emailHelp"
                                       placeholder="Enter Finance Type...">

                                @error('type')
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
