@section('report-active', 'active')
@section('report_sale', 'active')
@section('report', 'show')
@extends('layouts.backend.app',[
    'title' => 'Sale Report',
])
@push('css')
<link href="{{ asset('template/backend/sb-admin-2') }}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush
<style>
    #modal-dialog {
        max-width: 1000px;
        margin: 1.75rem auto;
    }
</style>
@section('content')
<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="font-size: 15px;">
                <thead class="bg-info" style="color: white;">
                    <tr>
                        <th hidden>Id</th>
                        <th>Date</th>
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
                            <td hidden>{{$row->id}}</td>
                            <td id="view">{{$row->date}}</td>
                            <td id="view">{{$row->customer_name}}</td>
                            <td id="view">{{$row->warehouse_name}}</td>
                            <td id="view">{{$row->payment_name}}</td>
                            <td id="view">{{$row->discount}}</td>
                            <td id="view">{{$row->grand_total}}</td>
                            <td>{{$row->total}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
    </div>
</div>

<div class="modal fade" id="modal_view" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" id="modal-dialog">
      <div class="modal-content" >
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Purchases Invoice</h5>
      
          <a href="/purchases/view/" target="_blank" class="btn btn-info btn-sm"  id="Marothon"> <i class="far fa-file-alt"></i> Print</a>
          
        </div>
        <div class="modal-body" id="info">
            <div class="form-group">
                <div class="row invoice-info">
                    <div class="col-sm-6 invoice-col">
                      <address>
                        <span><b>Supplier</b>: <span id="supplier" value=""></span></span><br>
                        <span><b>Email</b>: <span id="supplier_email" value=""></span></span><br>
                        <span><b>Address</b>: <span id="supplier_address" value=""></span></span><br>
                        <span><b>Tel</b>: <span id="supplier_phone" value=""></span></span><br>
                    </div>
                    <div class="col-sm-6 invoice-col">
                        <span><b>Date</b>: <span id="date" value=""></span></span><br>
                        <span><b>Reference</b>: <span id="reference" value=""></span></span><br>
                        <span><b>Warehouses</b>: <span id="warehouse" value=""></span></span><br>
                        <span><b>Payment</b>: <span id="payment" value=""></span></span><br>
                    </div>
                    <!-- /.col -->
                  </div>
                <div class="table-responsive">
                    <table id="viewTable" class="table table-bordered"  width="100%" cellspacing="0">
                        <thead style=" background-color:#36b9cc;color: #000000b8 ;text-align:center">
                            <tr>
                                <th>No</th>
                                <th>Product (Code - Name)</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Discount</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody id="tbody" style="text-align:center">
                        </tbody>
                    </table>
                </div>
                
            </div>
            <div class="row">
                <!-- accepted payments column -->
                <div class="col-6">
                  <p class="lead">Payment Methods</p>
                  <img src="/images/credit/visa.png" alt="Visa">
                  <img src="/images/credit/mastercard.png" alt="Mastercard">
                  <img src="/images/credit/american-express.png" alt="American Express">
                  <img src="/images/credit/paypal2.png" alt="Paypal">
          
                  <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                    A purchase order is a commercial document and first official offer issued by a buyer to a seller indicating types, quantities and agreed prices for products or services. It is used to control the purchasing of products and services from external suppliers.
                  </p>
                </div>
                <!-- /.col -->
                <div class="col-6">
                  <div class="table-responsive">
                    <table class="table">
                      <tbody><tr>
                        <th style="width:50%" >Total:</th>
                        <td id="total" value=""></td>
                      </tr>
                      {{-- <tr>
                        <th>Tax</th>
                        <td>$0.00</td>
                      </tr> --}}
                      {{-- <tr>
                        <th>Shipping:</th>
                        <td id="shipping" value=""></td>
                      </tr> --}}
                      <tr>
                        <th>Discount:</th>
                        <td id="total_discount" value=""></td>
                      </tr>
                      <tr>
                        <th>GrandTotal:</th>
                        <td id="grandtotal" value=""></td>
                      </tr>
                    </tbody></table>
                  </div>
                </div>
                <!-- /.col -->
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
            console.log(data);
            var id = data[0];
            $('#date').text(data[1]);
            $('#reference').text(data[2]);
            $('#warehouse').text(data[4]);
            $('#supplier').text(data[3]);
            $('#total_discount').text('$'+ parseFloat(data[5]).toFixed(2));
            $('#total').text('$'+ parseFloat(data[6]).toFixed(2));
            $('#grandtotal').text('$'+ parseFloat(data[7]).toFixed(2));
            $("#Marothon").attr('href','/pos/view/'+data[0]);
            $.ajax({
                url:"/api/sales/where/"+id,
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
                    +"<td>"+row.cost+"</td>"
                    +"<td>"+row.quantity+"</td>"
                    +"<td>"+row.discount+"</td>"
                    +"<td>"+row.subtotal+"</td>"+
                    "</tr>")
                }) 
                },
            });
            $('#modal_view').modal('show');
            $('#viewTable tbody').empty();
            $('#tbody').empty();
        })
    });

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