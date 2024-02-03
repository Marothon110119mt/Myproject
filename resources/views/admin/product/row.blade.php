@section('production-active', 'active')
@section('list_row', 'active')
@section('production', 'show')
@extends('layouts.backend.app',[
    'title' => 'List Row',
    'pageTitle' => 'List Row',
])
@push('css')
<link href="{{ asset('template/backend/sb-admin-2') }}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
            <a href="/product/create" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Add Product</a>
        </h6>
    </div>
    <div class="card-body">
        @if ($Row)

        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Code</th>
                        <th>Type</th>
                        <th>Quantity</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($Row as $row)
                        <tr>
                        <th scope="row"  width="1%">{{$loop->iteration}}</th>
                        <td><img src="/upload/product/{{$row->photo}}" alt="" width="80px" height="80px"></td>
                        <td>{{$row->name}}</td>
                        <td>{{$row->code}}</td>
                        <td>
                            @if ($row->type == 'Row')
                            Row
                            @endif
                            @if ($row->type == 'Middle')
                            Middle
                            @endif
                            @if ($row->type == 'Final' )
                            Final
                            @endif
                        </td>
                        <td>{{$row->row ?? '0'}}</td>
                        <td style="text-align: center">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="/product/{{$row->id}}/edit" class="btn btn-primary btn-sm mr-1"><i class="fas fa-edit"></i></a>
                                <a href="/product/{{$row->id}}/question" class="btn btn-danger btn-sm mr-1"><i class="fas fa-trash"></i></a>
                            </div>
                        </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Code</th>
                        <th>Type</th>
                        <th>Quantity</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
            </table>
        </div>
        {{-- {{$product->links()}} --}}
        @else
            @if (session('search'))
                    {!! session('search') !!}
            @else
                    <div class="alert alert-info mt-4" role="alert">
                        Product Not Found
                    </div>
            @endif
        @endif
    </div>
</div>
@stop

@push('js')
<script src="{{ asset('template/backend/sb-admin-2') }}/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="{{ asset('template/backend/sb-admin-2') }}/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="{{ asset('template/backend/sb-admin-2') }}/js/demo/datatables-demo.js"></script>
@endpush