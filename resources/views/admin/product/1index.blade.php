@section('product-active', 'active')
@section('list_product', 'active')
@section('product', 'show')
@extends('layouts.backend.app',[
    'title' => 'List Prodcut',
    'pageTitle' => 'List Prodcut',
])
@section('content')
    <!-- Page Heading -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6> 
                <a href="/product/create" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Add Product</a>
                    <!-- Topbar Search -->
                <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" action="/product/search" method="POST">
                    <div class="input-group">
                        @csrf
                    <input type="text" style="border-radius: 5px;" class="form-control text-gray-500 border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" name="search" value="{{$search ? $search : ''}}">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">
                        <i class="fas fa-search fa-sm"></i>
                        </button>
                    </div>
                    </div>
                </form>
            </h6>
        </div>
        <div class="card-body">
            @if ($product[0])
                    <table class="table mt-4 table-hover table-bordered center">
                        <thead style="text-align: center;">
                            <tr>
                            <th>No</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Code</th>
                            <th>Type</th>
                            <th>Cost</th>
                            <th>Price</th>
                            <th>Unit</th>
                            <th>Brand</th>
                            <th>Category</th>
                            <th>Quantity</th>
                            <th>Action</th>
                            </tr>
                        </thead>
                    
                        <tbody>
                            @foreach ($product as $row)
                                <tr>
                                <th scope="row"  width="1%">{{$loop->iteration}}</th>
                                <td><img src="/upload/product/{{$row->photo}}" alt="" width="80px" height="80px"></td>
                                {{-- <td><img src="/images/backend/laravel.jpg" alt="" width="80px" height="80px"></td> --}}
                                <td>{{$row->name}}</td>
                                <td>{{$row->code}}</td>
                                <td>
                                      
                                      @if ($row->type == 1)
                                      Standard
                                      @endif
                                      @if ($row->type == 2)
                                      Row
                                      @endif
                                      @if ($row->type == 3)
                                      Issue
                                      @endif
                                </td>
                                <td>{{$row->cost}}</td>
                                <td>{{$row->price}}</td>
                                <td>{{$row->unit_name->name??''}}</td>
                                <td>{{$row->brand_name->name??''}}</td>
                                <td>{{$row->category_name->name??''}}</td>
                                <td>{{$row->quantity ?? '0'}}</td>
                                <td style="text-align: center">
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <a href="/product/{{$row->id}}/edit" class="btn btn-primary btn-sm mr-1"><i class="fas fa-edit"></i></a>
                                        <a href="/product/{{$row->id}}/question" class="btn btn-danger btn-sm mr-1"><i class="fas fa-trash"></i></a>
                                    </div>
                                </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
    
                    {{$product->links()}}
            @else
                @if (session('search'))
                        {!! session('search') !!}
                @else
                        <div class="alert alert-info mt-4" role="alert">
                            Anda belum mempunyai data
                        </div>
                @endif
            @endif
        </div>
    </div>
@endsection

@section('search-url', '/product/search')

@section('search')
    @include('sb-admin/search')
@endsection

@section('search-responsive')
    @include('sb-admin/search-responsive')
@endsection
