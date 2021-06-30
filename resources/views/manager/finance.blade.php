@extends('layouts.master')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-5">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
        </div>
    </div>
    <div class="container">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Finance Management</h1>

        </div>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">New Finance Record Type</h6>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="" class="finance">
                            @csrf
                            <div class="row justify-content-center">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text"
                                               class="form-control form-control-finance @error('type') is-invalid @enderror"
                                               id="type" name="type" value="{{ old('type') }}" required
                                               autocomplete="type"
                                               autofocus aria-describedby="emailHelp"
                                               placeholder="Enter Finance Type...">

                                        @error('type')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="number"
                                               class="form-control form-control-user @error('dividends') is-invalid @enderror"
                                               id="dividends" name="dividends" value="{{ old('dividends')}}" required
                                               autocomplete="dividends"
                                               autofocus aria-describedby="emailHelp"
                                               placeholder="Enter Finance Dividends...">

                                        @error('dividends')
                                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <button class="btn btn-success" type="submit">Submit</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">List of All Registered Finances Type</h6>
            </div>
            <div class="card-body">
                @if($finances->isNotEmpty())
                    <div class="table-responsive">
                        <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <div class="row justify-content-end">
                                <div class="col-sm-12 col-md-6"></div>
                                <div class="col-sm-12 col-md-6">
                                    <form action="{{ route('finances.index') }}" method="GET" role="search"
                                          class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 table-search p-2">
                                        <div class="input-group">
                                            <input name="term" id="term" type="text"
                                                   class="form-control bg-light border-0 small"
                                                   placeholder="Search for..." aria-label="Search"
                                                   aria-describedby="basic-addon2">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary" type="submit" title="Search projects">
                                                    <i class="fas fa-search fa-sm"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <table class="table table-bordered dataTable" id="dataTable" width="100%"
                                           cellspacing="0" role="grid" aria-describedby="dataTable_info"
                                           style="width: 100%;">
                                        <thead>
                                        <tr role="row">
                                            <th class="sorting sorting_asc" tabindex="0" aria-controls="dataTable"
                                                rowspan="1" colspan="1" aria-sort="ascending"
                                                aria-label="Name: activate to sort column descending"
                                                style="width: 161px;">
                                                Finance Type
                                            </th>
                                            <th class="sorting sorting_asc" tabindex="0" aria-controls="dataTable"
                                                rowspan="1" colspan="1" aria-sort="ascending"
                                                aria-label="Name: activate to sort column descending"
                                                style="width: 161px;">
                                                Dividends
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-label="Position: activate to sort column ascending"
                                                style="width: 248px;">Created On
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-label="Salary: activate to sort column ascending"
                                                style="width: 97px;">Action
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($finances as $finance)
                                            <tr class="odd">
                                                <td class="sorting_1">{{$finance->type}}</td>
                                                <td class="sorting_1">{{$finance->dividends}}%</td>
                                                <td>{{date('d M Y', strtotime($finance->created_at))}}</td>
                                                <td>
                                                    <a href="finances/{{ $finance->id }}/edit"
                                                       class="btn-circle btn-success"><i
                                                            class="fas fa-edit"></i></a>
                                                    <a href="/finances/{{$finance->id}}/delete"
                                                       class="btn-circle btn-danger"><i
                                                            class="fas fa-trash"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    <div class="d-flex justify-content-center">
                                        {{ $finances->appends(['sort' => 'role'])->links() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="row justify-content-center">
                        <div class="alert alert-danger col-md-6 text-center">
                            <h6>No Data Found!</h6>
                        </div>
                    </div>
            </div>
            @endif
        </div>


    </div>

@endsection
