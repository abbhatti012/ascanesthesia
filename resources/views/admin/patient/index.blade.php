@extends('layouts.backend')

@section('css_before')
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables/dataTables.bootstrap4.css') }}">
@endsection

@section('js_after')
    <script src="{{ asset('js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <script src="{{ asset('js/pages/tables_datatables.js') }}"></script>
@endsection

@section('content')
    <div class="content">
        <div class="my-50">
            <h2 class="content-heading">All Patients |
                <a href="{{ route('add-patient') }}"> 
                    <button type="button" class="btn btn-success ">
                        <i class="fa fa-plus mr-5"></i>Add Patient
                    </button>
                </a>
            </h2>
        </div>

        <div class="block">
            @if(Session::has('message'))
                <div class="alert alert-{{session('message')['type']}}">
                    {{session('message')['text']}}
                </div>
            @endif
            <div class="block-header block-header-default">
                <h3 class="block-title">Patient Details</h3>
            </div>
            <div class="block-content block-content-full">
                <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 80px;">#</th>
                            <th>Name</th>
                            <th class="d-none d-sm-table-cell" style="width: 30%;">Email</th>
                            <th style="width: 15%;">Registered At</th>
                            <th style="width: 15%;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                        <tr>
                            <td class="text-center">{{ $loop->index + 1 }}</td>
                            <td class="font-w600">
                                <a href="javascript:void(0)">{{ $user->name }}</a>
                            </td>
                            <td class="d-none d-sm-table-cell">
                                <a href="mailto:{{ $user->email }}">{{ $user->email }}</a>
                            </td>
                            <td>
                                <em class="text-muted">{{ $user->created_at->format("F j, Y") }}</em>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('edit-patient', $user->id) }}">
                                        <button type="button" class="btn btn-lg btn-circle btn-alt-success mr-5 mb-5 " title="Edit Patient" >
                                            <i class="fa fa-pencil"></i>
                                        </button>
                                    </a>
                                    <a href="{{ route('delete-user', $user->id) }}" class="js-swal-confirm btn btn-lg btn-circle btn-alt-danger mr-5 mb-5" title="Delete Patient">
                                        <i class="fa fa-times"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection