@section('production-active', 'active')
@section('list_process', 'active')
@section('production', 'show')
@extends('layouts.backend.app',[
    'title' => 'List Process',
    'pageTitle' => 'List Process',
])
@push('css')
<link href="{{ asset('template/backend/sb-admin-2') }}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
            <a href="/process/create" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Add Process</a>
        </h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Date</th>
                        <th>Reference</th>
                        <th>Warehouse</th>
                        <th>Action</th>
                        <th hidden>id</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($Process as $row)
                        <tr>
                        <th scope="row"  width="1%">{{$loop->iteration}}</th>
                        <td>{{$row->created_at}}</td>
                        <td id="view" value="{{$row->id}}">{{$row->reference_no}}</td>
                        <td id="view" value="{{$row->id}}">{{$row->warehouse_name->name}}</td>
                        <td style="text-align: center">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a data-toggle="modal" id="view" value="{{$row->id}}" class="btn btn-info btn-sm mr-1"><i class="fas fa-eye"></i></a>
                                <a href="/issue/{{$row->id}}/edit" class="btn btn-primary btn-sm mr-1"><i class="fas fa-edit"></i></a>
                                <a href="/issue/{{$row->id}}/question" class="btn btn-danger btn-sm mr-1"><i class="fas fa-trash"></i></a>
                            </div>
                        </td>
                        <td hidden>{{$row->id}}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Date</th>
                        <th>Reference</th>
                        <th>Warehouse</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
            </table>
        </div>

    </div>
</div>
<div class="modal fade" id="modal_view" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" id="modal-dialog">
      <div class="modal-content" >
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Information</h5>
      
          <a href="/process/view/" target="_blank" class="btn btn-info btn-sm"  id="Marothon"> <i class="far fa-file-alt"></i> Print</a>
          
        </div>
        <div class="modal-body" id="info">
            <div class="form-group">
                <div>
                    <span><b>Date</b>: <span id="date" value=""></span></span><br>
                    <span><b>Reference</b>: <span id="reference" value=""></span></span><br>
                    <span><b>Warehouses</b>: <span id="warehouse" value=""></span></span><br>
                </div>
                <div class="table-responsive">
                    <table id="viewTable" class="table table-bordered"  width="100%" cellspacing="0">
                        <thead style=" background-color:#36b9cc;color: #000000b8 ;text-align:center">
                            <tr>
                                <th>No</th>
                                <th>Product (Code - Name)</th>
                                <th>Quantity</th>
                                <th>type</th>
                            </tr>
                        </thead>
                        <tbody id="tbody" style="text-align:center">
                        </tbody>
                    </table>
                </div>
                
            </div>
        </div>
      </div>
    </div>
</div>
@stop

@push('js')
<script type="text/javascript">

    $(document).ready(function(){
        var table = $('#dataTable').DataTable();
        table.on('click','#view',function(){
            $tr = $(this).closest('tr');
            if($($tr).hasClass('child')){
                $tr = $tr.prev('.parent') ;
            }
            var data = table.row($tr).data();
            var id = data[5];
            $('#date').text(data[1]);
            $('#reference').text(data[2]);
            $('#warehouse').text(data[3]);
            $("#Marothon").attr('href','/process/view/'+data[5]);
            $.ajax({
                url:"/api/process/where/"+id,
                type: 'get',
                dataType: "json",
                cache: false,
                success: function( data ) {
                id_row = 0
                $.each(data,function(index,row){
                id_row++
                    $('#viewTable tbody').append("<tr>"
                    +"<td>"+id_row+"</td>"
                    +"<td>"+row.label+"</td>"
                    +"<td>"+row.quantity+"</td>"
                    +"<td>"+row.type+"</td>"+
                    "</tr>")
                }) 
                },
            });
            $('#modal_view').modal('show');
            $('#viewTable tbody').empty();
        })
    });

    $(".close_unit").click(function(){
        $('#modal_view').modal('hide')
    });
</script>
<script src="{{ asset('template/backend/sb-admin-2') }}/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="{{ asset('template/backend/sb-admin-2') }}/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="{{ asset('template/backend/sb-admin-2') }}/js/demo/datatables-demo.js"></script>
@endpush