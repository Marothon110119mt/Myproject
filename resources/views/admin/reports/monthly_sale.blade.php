@section('report-active', 'active')
@section('report_monthlysale', 'active')
@section('report', 'show')
@extends('layouts.backend.app',[
    'title' => 'Report Monthly Sale',
])
@push('css')
<link href="{{ asset('template/backend/sb-admin-2') }}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush
@section('content')
<div class="card shadow mb-4">
    <div class="card-header" style="padding: 0.35rem 1.25rem;">
        <h6 class="m-0 font-weight-bold text-info">
            <div style="float: left;margin-top: 8px;font-size: 20px;">
                Monthly Sale Report
              </div>     
              <div style="float: right;margin-right: -12px;font-size: 20px;">
                  <table>
                    <th class="th">
                      <button class="btn show_register bg-info" id="show_register">
                        <i class="fas fa-caret-square-down " style="color: white;font-size: 20px;"></i> 
                      </button>
                    </th>
                    <th class="th">
                      <button class="btn hide_register bg-info">
                        <i class="fas fa-caret-square-up" style="color: white;font-size: 20px;"></i>
                      </button>
                    </th>
                  </table>
              </div> 
        </h6>
    </div>
    <div id="register">
        <form action="/report/monthly_sale" method="GET" enctype="multipart/form-data">

          <div class="row col-12" style="margin: 0;">
              <div class="col-3">
                <div class="form-group">
                    <label for="customer">Customer</label>
                    <select class="form-control" id="customer" name="customer">
                        <option selected disabled>Select Customer</option>
                        @foreach ($customer as $row)
                            <option value="{{$row->id}}">{{$row->name}}</option>
                        @endforeach
                    </select>
                </div>
              </div>
              <div class="col-3">
                <div class="form-group">
                    <label for="warehouse">Warehouse</label>
                    <select class="form-control" id="warehouse" name="warehouse">
                        <option selected disabled>Select Warehouse</option>
                        @foreach ($warehouse as $row)
                            <option value="{{$row->id}}">{{$row->name}}</option>
                        @endforeach
                    </select>
                </div>
              </div>
              <div class="col-3">
                <div class="form-group">
                    <label for="payment_method">Payment Method</label>
                    <select class="form-control" id="payment_method" name="payment_method">
                        <option selected disabled>Select Payment</option>
                        @foreach ($payment_method as $row)
                            <option value="{{$row->id}}">{{$row->name}}</option>
                        @endforeach
                    </select>
                </div>
              </div>
              <div class="col-3">
                {{-- <label for="end_date">End Date</label>
                <input type="date" class="form-control " id="end_date" name="end_date"> --}}
              </div>
        <button type="submit" class="btn btn-info" style="margin-left: 10px;">Submit</button>
          </div>
    </form>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="font-size: 15px;">
                <thead class="bg-info" style="color: white;">
                    <tr>
                        <th>Date</th>
                        <th>Reference</th>
                        <th>Customer</th>
                        <th>Warehouse</th>
                        <th>Paid By</th>
                        <th>Discount</th>
                        <th>Grand Total</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sales as $row)
                        <tr>
                            <td>{{$row->date}}</td>
                            <td>{{$row->date}}</td>
                            <td>{{$row->customer_name}}</td>
                            <td>{{$row->warehouse_name}}</td>
                            <td>{{$row->payment_name}}</td>
                            <td>{{$row->discount}}</td>
                            <td>{{$row->grand_total}}</td>
                            <td>{{$row->total}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
    </div>
</div>
@stop

@push('js')
<script type="text/javascript">
        $('#register').hide();
    $(".show_register").click(function () {
    $("#register").slideDown();
    });
    $(".hide_register").click(function () {
    $("#register").slideUp();
    });
</script>
<script src="{{ asset('template/backend/sb-admin-2') }}/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="{{ asset('template/backend/sb-admin-2') }}/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="{{ asset('template/backend/sb-admin-2') }}/js/demo/datatables-demo.js"></script>
@endpush