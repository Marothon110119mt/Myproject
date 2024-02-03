@section('report-active', 'active')
@section('report_product', 'active')
@section('report', 'show')
@extends('layouts.backend.app',[
    'title' => 'Report Products',
])
@push('css')
<link href="{{ asset('template/backend/sb-admin-2') }}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-info">
            Report Products
        </h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="font-size: 15px;">
                <thead class="bg-info" style="color: white;">
                    <tr>
                        <th>Row</th>
                        <th>Code</th>
                        <th>Name</th>
                        <th>Purchased</th>
                        <th>Sold</th>
                        <th>Profit / Loss</th>
                        <th>Stock (Qty) Amt</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($product as $row)
                        <tr>
                        <td>
                            @if ($row->photo)
                                    <img src="/upload/product/{{$row->photo}}" width="40px" height="40px" class="img-rounded">
                                    @else 
                                    <img src="/upload/no_image.jpg" alt="" width="40px" height="40px">
                                    @endif
                        </td>
                        <td>{{$row->code}}</td>
                        <td>{{$row->name}}</td>
                        <td style="text-align: right;font-weight: bold;"> <span style="font-weight: 400;">({{$row->product_quantity ?? 0}})</span>{{number_format($row->product_price, 2)}}</td>
                        <td style="text-align: right;font-weight: bold;"> <span style="font-weight: 400;">({{$row->sale_quantity ?? 0}})</span>
                                {{number_format($row->sale_price, 2)}}
                        </td>
                        <td style="text-align: right;font-weight: bold;">{{number_format($row->sale_price - $row->product_price ,2) }}</td>
                        <td style="text-align: right;font-weight: bold;">
                            <span style="font-weight: 400;">({{$row->quantity ?? 0}})</span>
                            {{number_format($row->quantity * $row->cost,2)}}
                        </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
    </div>
</div>
@stop

@push('js')
<script src="{{ asset('template/backend/sb-admin-2') }}/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="{{ asset('template/backend/sb-admin-2') }}/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="{{ asset('template/backend/sb-admin-2') }}/js/demo/datatables-demo.js"></script>
@endpush