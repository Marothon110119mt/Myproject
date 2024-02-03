@section('report-active', 'active')
@section('report_category', 'active')
@section('report', 'show')
@extends('layouts.backend.app',[
    'title' => 'Report Categories',
])
@push('css')
<link href="{{ asset('template/backend/sb-admin-2') }}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush
@section('content')
<div class="card shadow mb-4">
    <div class="card-header" style="padding: 0.35rem 1.25rem;">
        <h6 class="m-0 font-weight-bold text-info">
            <div style="float: left;margin-top: 8px;font-size: 20px;">
                Categories Report
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
        <form action="/report/category" method="GET" enctype="multipart/form-data">

          <div class="row col-12" style="margin: 0;">
              <div class="col-3">
                <div class="form-group">
                    <label for="category">Category</label>
                    <select class="form-control" id="category" name="category">
                        <option selected disabled>Select Category</option>
                        @foreach ($category as $row)
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
                <label for="sart_date">Sart Date</label>
                <input type="date" class="form-control " id="sart_date" name="sart_date">
              </div>
              <div class="col-3">
                <label for="end_date">End Date</label>
                <input type="date" class="form-control " id="end_date" name="end_date">
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
                        <th>Row</th>
                        <th>Code</th>
                        <th>Name</th>
                        <th>Purchased</th>
                        <th>Sold</th>
                        <th>Purchased Amount</th>
                        <th>Sold Amount</th>
                        <th>Profit / Loss</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($product as $row)
                        <tr>
                        <td>
                            @if ($row->photo)
                                    <img src="/upload/{{$row->photo}}" width="40px" height="40px" class="img-rounded">
                                    @else 
                                    <img src="/upload/no_image.jpg" alt="" width="40px" height="40px">
                            @endif
                        </td>
                        <td>{{$row->code}}</td>
                        <td>{{$row->name}}</td>
                        <td style="text-align: right;font-weight: bold;">
                           {{number_format($row->pur_quantity, 2) ?? 0.00}}
                        </td>
                        <td style="text-align: right;font-weight: bold;">
                            {{number_format($row->sale_quantity, 2)}}
                        </td>
                        <td style="text-align: right;font-weight: bold;">
                            {{number_format($row->pur_quantity,2)}}
                        </td>
                        <td style="text-align: right;font-weight: bold;">
                            {{number_format($row->sale_price,2) }}
                        </td>
                        <td style="text-align: right;font-weight: bold;">
                            {{number_format($row->sale_price - $row->pur_quantity ,2) }}
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
<script type="text/javascript">
    $(document).ready( function () {
        $('#register').hide();
        var table = $('.dataTable').DataTable({
            processing:true,
            serverSide:true,
            ajax:{
                "url":"{{route('report/category')}}",
                "data": function(d){
                    d.category =$('#category').val('1212')
                    d.warehouse=$('#warehouse').val()
                    d.start_date=$('#start_date').val()
                    d.end_date=$('#end_date').val()
                }
                
            }
        })
    } );
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