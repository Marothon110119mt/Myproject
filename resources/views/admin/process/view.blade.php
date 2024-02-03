
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Marothon | Process Print</title>
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
          <i class="fas fa-globe"></i> Marothon, Inc.
          <small class="float-right">Date: {{$Process->created_at}}</small>
        </h2>
      </div>
      <!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info">
      <div class="col-sm-4 invoice-col">
        <address>
          <strong>Warehouse : {{$Process->warehouse_name->name}}</strong><br>
          F2VH+QWF, Unnamed Road<br>
          Krong Kracheh<br>
        </address>
      </div>
      <!-- /.col -->
      <div class="col-sm-4 invoice-col">
      </div>
      <!-- /.col -->
      <div class="col-sm-4 invoice-col">
        <b>Reference_no</b> : # {{$Process->reference_no}}<br>
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
                  <th>type</th>
              </tr>
          </thead>
          <tbody style="text-align:center">
              @foreach ($Process_Item as $row)
                  <tr>
                  <th scope="row"  width="1%">{{$loop->iteration}}</th>
                  <td id="view" value="{{$row->id}}">{{$row->product_name}} - {{$row->product_code}} </td>
                  <td id="view" value="{{$row->id}}">{{$row->product_quantity}}</td>
                  <td id="view" value="{{$row->id}}">{{$row->product_type}}</td>
                  </tr>
              @endforeach
          </tbody>
      </table>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
    <div class="row">
      <!-- accepted payments column -->
      <div class="col-12">
        <div>
          Note
        </div>
        <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
          System software is a type of computer program that is designed to run a computer's hardware and application programs. If we think of the computer system as a layered model, the system software is the interface between the hardware and user applications. The operating system is the best-known example of system software.
        </p>
      </div>
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
  <a href="/process/" target="_blank" class="btn btn-danger btn-sm no-print"  > <i class="far fa-file-alt"></i> Back</a>
  <a href="{{ url('process/view', $Process->id) }}" target="_blank" class="btn btn-info btn-sm no-print"  > <i class="far fa-file-alt"></i>Print </a>

</div>
<!-- ./wrapper -->
<!-- Page specific script -->
<script>
  window.addEventListener("load", window.print());
</script>
</body>
</html>
