
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Marothon | Invoice Print</title>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link href="{{ asset('template/backend/sb-admin-2') }}/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <!-- Theme style -->
  <link href="{{ asset('template/backend/sb-admin-2') }}/css/sb-admin-2.min.css" rel="stylesheet">
</head>
    <style type="text/css" media="print,screen">
        #Marothon{
          background-color:#36b9cc !important;
          color: #000000b8 !important;
          text-align:center !important
        }
        .wrapper{
            padding-bottom: 50px;
            padding-left: 50px;
            padding-right: 50px;
            padding-top: 50px;
          }
          @media print{
            #Marothon , #Marothon * {
              background-color:#36b9cc !important;
              color: #000000b8 !important;
              text-align:center !important
            }
            .no-print, .no-print *
              {
                  display: none !important;
              }
          }
      </style>
<body>
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-12">
        <h2 class="page-header">
          <i class="fas fa-globe"></i> 3Brother, Inc.
          <small class="float-right">Date: {{$sale->created_at}}</small>
        </h2>
      </div>
      <!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info">
      <div class="col-sm-4 invoice-col">
        <address>
          <strong>Warehouse : {{$sale->warehouse_name->name}}</strong><br>
          F2VH+QWF, Unnamed Road<br>
          Krong Kracheh<br>
        </address>
      </div>
      <!-- /.col -->
      <div class="col-sm-4 invoice-col">
      </div>
      <!-- /.col -->
      <div class="col-sm-4 invoice-col">
        <b>Customer</b> : # {{$sale->customer_name->name}}<br>
        Phone: (+855)968877203<br>
        Email: chanMarothon2222@gmail.com
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
    <!-- Table row -->
    <div class="row">
      <div class="col-12 table-responsive">
        <table id="viewTable" class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead id="Marothon">
              <tr>
                  <th>No</th>
                  <th>Product (Code - Name)</th>
                  <th>Quantity</th>
                  <th>Price</th>
                  <th>Total</th>
              </tr>
          </thead>
          <tbody style="text-align:center">
              @foreach ($sale_item as $row)
                  <tr>
                  <th scope="row"  width="1%">{{$loop->iteration}}</th>
                  <td id="view" value="{{$row->id}}">{{$row->product_name}} - {{$row->product_code}} </td>
                  <td id="view" value="{{$row->id}}">{{$row->product_quantity}}</td>
                  <td id="view" value="{{$row->id}}">{{$row->product_price}}</td>
                  <td id="view" value="{{$row->id}}">{{$row->product_subtotal}}</td>
                  </tr>
              @endforeach
          </tbody>
      </table>
      </div>
      <!-- /.col -->
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
            <tbody>
              <tr>
                <th>Total Paying</th>
                <td>( <span>{{$sale->paid ?? 0 }}</span>$ ) <span>( {{$sale->paid_khmer ?? 0 }}៛ )</span></td>
              </tr>
              <tr>
                <th>Change</th>
                <td>( <span>{{$sale->balance ?? 0 }}</span>$ ) <span>( {{$sale->balancekhmer ?? 0 }}៛ )</span></td>
              </tr>
              <tr>
                <th>Discount</th>
                <td>{{$sale->discount}}</td>
              </tr>
              <tr>
                <th>GrandTotal:</th>
                <td id="grandtotal" value="">{{$sale->total}}</td>
              </tr>
              <tr>
                 <th style="width:50%" >Total:</th>
              <td id="total" value=""> {{$sale->total}}</td>
            </tr>
            
          </tbody></table>
        </div>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
  <a href="/pos" class="btn btn-danger btn-sm no-print"  > <i class="far fa-file-alt"></i> Back</a>
  <a href="{{ url('pos/view', $sale->id) }}" class="btn btn-info btn-sm no-print"  > <i class="far fa-file-alt"></i>Print </a>

</div>
<!-- ./wrapper -->
<!-- Page specific script -->
<script>
  window.addEventListener("load", window.print());
</script>
</body>
</html>
