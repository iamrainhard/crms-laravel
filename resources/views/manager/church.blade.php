@extends('layouts.master')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-5">
            @if (session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
        </div>
    </div>
    <div class="container">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Church Branches Management</h1>
            <a href="/churches/create"
               class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-user-plus fa-sm text-white-50"></i> Register Church</a>
        </div>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">List of All Registered Churches</h6>
            </div>
            <div class="card-body">
                @if($churches->isNotEmpty())
                    <div class="table-responsive">
                        <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <div class="row justify-content-end">
                                <div class="col-sm-12 col-md-6"></div>
                                <div class="col-sm-12 col-md-6">
                                    <form action="{{ route('churches.index') }}" method="GET" role="search"
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
                                                Branch Name
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-label="Position: activate to sort column ascending"
                                                style="width: 248px;">Senior Pastor
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-label="Position: activate to sort column ascending"
                                                style="width: 248px;">Church Elders
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-label="Office: activate to sort column ascending"
                                                style="width: 114px;">Region
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-label="Start date: activate to sort column ascending"
                                                style="width: 108px;">Established On
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-label="Salary: activate to sort column ascending"
                                                style="width: 97px;">Action
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($churches as $church)
                                            <tr class="odd">
                                                <td class="sorting_1">{{$church->name}}</td>
                                                <td>
                                                    @if($church->users->where('role','pastor')->isNotEmpty())
                                                        <div class="font-weight-bold">{{$church->users->where('role','pastor')->first()->firstName}}
                                                            {{$church->users->where('role','pastor')->first()->sirName}}</div>
                                                        <div
                                                            class="small">{{$church->users->where('role','pastor')->first()->mobile}}</div>
                                                    @else
                                                        <div class="alert alert-warning text-center">Not Assigned!</div>
                                                    @endif
                                                </td>
                                                <td>
                                                    <ol>
                                                        @forelse ($church->users->where('role','elder') as $elder)

                                                            <li class="small">{{$elder->firstName}}
                                                                {{$elder->sirName}}</li>
                                                        @empty
                                                            <div class="alert alert-warning text-center">Not Assigned!
                                                            </div>
                                                        @endforelse
                                                    </ol>
                                                </td>
                                                <td>{{$church->region->region}}</td>
                                                <td>{{date('d M Y', strtotime($church->created_at))}}</td>
                                                <td>
                                                    <a href="/churches/{{ $church->id }}/edit"
                                                       class="btn-circle btn-success"><i
                                                            class="fas fa-edit"></i></a>
                                                    <a href="/churches/{{$church->id}}/delete"
                                                       class="btn-circle btn-danger"><i
                                                            class="fas fa-trash"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    <div class="d-flex justify-content-center">
                                        {{ $churches->appends(['sort' => 'role'])->links() }}
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
                @endif
            </div>

        </div>
    </div>

@endsection
