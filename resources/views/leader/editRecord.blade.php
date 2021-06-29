@extends('layouts.master')

@section('content')
    <div class="container">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Finance Record Edit</h1>
        </div>
        <div class="row">
            <div class="col-8">
                <div class="card shadow">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Finance Record Edit Form</h6>
                    </div>
                    <div class="card-body">
                        <form action="/records/{{$record->id}}" class="form" method="POST">
                            @method('PATCH')
                            @csrf

                            <div class="form-group">
                                <select name="finance_id" id="finance_id"
                                        class="form-control form-control-user @error('type') is-invalid @enderror">
                                    @foreach($finances as $finance)
                                        @if($record->finance_id === $finance->id)
                                            <option value="{{$finance->id}}" selected>{{$finance->type}}</option>
                                        @else
                                            <option value="{{$finance->id}}" selected>{{$finance->type}}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('finance_id')
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="number"
                                       class="form-control form-control-user @error('amount') is-invalid @enderror"
                                       id="amount" name="amount" value="{{ $record->amount }}" required
                                       autocomplete="amount"
                                       autofocus aria-describedby="emailHelp"
                                       placeholder="Enter Amount...">

                                @error('amount')
                                <span class="invalid-feedback" role="alert">
                                             <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="text"
                                       class="form-control form-control-user @error('description') is-invalid @enderror"
                                       id="description" name="description" value="{{ $record->description }}" required
                                       autocomplete="description"
                                       autofocus aria-describedby="emailHelp"
                                       placeholder="Enter Description...">

                                @error('description')
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
