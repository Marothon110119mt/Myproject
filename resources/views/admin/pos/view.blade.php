
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice No</title>
    <meta http-equiv="cache-control" content="max-age=0"/>
    <meta http-equiv="cache-control" content="no-cache"/>
    <meta http-equiv="expires" content="0"/>
    <meta http-equiv="pragma" content="no-cache"/>
    <link rel="stylesheet" href="/80cm/styles/theme.css" type="text/css"/>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <link href="{{ asset('template/backend/sb-admin-2') }}/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <style type="text/css" media="all">
    
        body { color: #000; }
        #wrapper { max-width: 480px; margin: 0 auto; padding-top: 20px; }
        .btn { border-radius: 0; margin-bottom: 5px; }
        .bootbox .modal-footer { border-top: 0; text-align: center; }
        h3 { margin: 5px 0; }
        .order_barcodes img { float: none !important; margin-top: 5px; }
        @media print {
            .no-print { display: none; }
            #wrapper { max-width: 480px; width: 100%; min-width: 250px; margin: 0 auto; }
            .no-border { border: none !important; }
            .border-bottom { border-bottom: 1px solid #ddd !important; }
            table tfoot { display: table-row-group; }
        }
    </style>
</head>

<body>
        <div id="wrapper">
    <div id="receiptData">
        <div id="receipt-data">
          
            <div class="text-center">
                <h3 style="text-transform:uppercase;"><i class="fas fa-globe"></i>3B Zone</h3>
                <div class="row invoice-info">
                  <div class="col-sm-6 invoice-col text-left" style="float: left">
                      <strong>W :</strong> {{$sale->warehouse_name->name}}<br>
                      <strong>T :</strong> 0968877203
                  </div>
                  <div class="col-sm-6 invoice-col text-right" style="float: right">
                      <strong>C :</strong> {{$sale->customer_name->name}}<br>
                      <strong>D :</strong> {{ $sale->date }} <br>
                  </div>
                </div>
            <table class="table table-condensed ">
                <thead id="Marothon">
                  <tr>
                      <th>Product</th>
                      <th>Qty</th>
                      <th>Price</th>
                      <th>Total</th>
                  </tr>
              </thead>
              <tbody style="text-align:center">
                  @foreach ($sale_item as $row)
                      <tr>
                      <td id="view">{{$row->product_name}} </td>
                      <td id="view">{{$row->product_quantity}}</td>
                      <td id="view">{{$row->product_price}}</td>
                      <td id="view">{{$row->product_subtotal}}</td>
                      </tr>
                  @endforeach
              </tbody>
                <tfoot>
                    <tr>
                        <th >Total</th>
                        <th colspan="3" class="text-right">
                          {{$sale->total}}
                        </th>
                    </tr>
                    @if($sale->discount > 0)
                      <tr>
                        <th>Discount</th>
                        <th colspan="3" class="text-right">
                          {{$sale->discount}}
                        </th>
                      </tr>
                    @endif
                    <tr>
                        <th>Grand Total</th>
                        <th colspan="3" class="text-right">
                          {{$sale->grand_total}}
                        </th>
                    </tr>
                </tfoot>
            </table>
            <table class="table table-striped table-condensed">
                <tbody>
                  <tr>
                    <td>Paid by<br> {{$sale->payment_name->name}}</td>
                    <td colspan="2">Amount <br> {{$sale->paid ?? 0 }}</td>
                    <td>Change<br>
                      <span class="text-right">{{$sale->balance ?? 0 }}</span>$
                    </td>
                  </tr>
                </tbody>
            </table>
            <p class="text-center"> Thank you for shopping with us. Please come again</p>
        </div>
    </div>
    <div id="buttons" style="padding-top:10px; text-transform:uppercase;" class="no-print">
        <hr>
            <span class="pull-right col-xs-12"><button onclick="window.print();" class="btn btn-block btn-primary">Print</button></span>
            <span class="col-xs-12">
                <a class="btn btn-block btn-warning" href="/pos">Back to POS</a>
            </span>
    </div>
</div>
    <script type="text/javascript" src="/80cm/js/jquery-2.0.3.min.js"></script>
        <script type="text/javascript">
        $(window).load(function () {
            window.print();
            return false;
        });
        
</script>
        </body>
</html>
