@extends('layouts.backend.pos',[
    'title' => 'POS',
])

@section('content')
<style>
    .well {
    border: 1px solid #ddd;
    background-color: #f6f6f6;
    box-shadow: none;
    border-radius: 0px;
    padding-top: 8px;}
    .table-bordered td, .table-bordered th {
    border: 1px solid #0000001f;
    }
    .table-bordered thead td, .table-bordered thead th {
    border-bottom-width: 2px;
    border: 1px solid #0000001f;

    }
    tbody{
        background-color: white;
    }
    .select2-container .select2-choice, .select2-result-label {
        font-size: 1.5em;
        height: 41px; 
        overflow: auto;
    }
    .select2-arrow, .select2-chosen {
    padding-top: 6px;
    }
    #poTable {
    background-color: white;
    overflow-x: hidden;
    display: block;
    height: 300px;
    }
    .table {
    width: 100%;
    margin-bottom: unset;
    color: #858796;
    }
    #item-list button{
    border: none;
    }
    #item-list button img{
        border-radius: 100px;
    }
    #productget {
    overflow-x: hidden;
    display: block;
    width: 765px;
    background: #a9a9a97a;
    height: 650px;
    }
</style>
@push('js')
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.12.4.js"></script>
<script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript">
    var data = {!! json_encode($product->toArray()) !!}
    if(localStorage.getItem('product')){
        localStorage.removeItem('product');
        loadItems()
    }
    $(document).on('change', '.quantity', function () {
            var id = $(this).parent().parent().find(".rid").val();
            var quantity = $(this).val();
            var storage = JSON.parse(localStorage.getItem('product'));
            
            $.each(storage,function(index,row){
                if(index == id){
                    storage[index].quantity = quantity;
                }
            })
        localStorage.setItem('product', JSON.stringify(storage));
        loadItems()
    });
    $("#remove").click(function(){
        $('#total_item').text('0');
        localStorage.removeItem('product');
        loadItems()
    });
    $(document).on('click', '.delete', function () {
            var id = $(this).parent().find(".rid").val();
            $('#total_item').text('0');
            var storage = JSON.parse(localStorage.getItem('product'));
            var newstorage=[];
            $.each(storage,function(index,row){
                if(index == id){
                }else{
                newstorage.push(row);
                }
            })
            localStorage.setItem('product', JSON.stringify(newstorage));
            loadItems()
    });
    $('#product').change(function(){
        var abc =$(this).val();
        var selected = data.filter(function(item) {
        return (item.id==abc);
        });
        var storage = localStorage.getItem('product') ? JSON.parse(localStorage.getItem('product')):[];
        storage.push(selected[0]);
        localStorage.setItem('product', JSON.stringify(storage));
        loadItems()
        $('#product').val('0');

    });
    $(document).on('change', '.discount', function () {
            var id = $(this).parent().parent().find(".rid").val();
            var discount = $(this).val();
            var storage = JSON.parse(localStorage.getItem('product'));
            $.each(storage,function(index,row){
                if(index == id){
                    storage[index].discount = discount;
                }
            })
        localStorage.setItem('product', JSON.stringify(storage));
        loadItems()
    });
    function loadItems() {
        $('#poTable tbody').empty();
            var storage = JSON.parse(localStorage.getItem('product'));
            let total = 0;
            let grand_total = 0;
            var totalitem = 0;
            var item_total = 0;
            $.each(storage,function(index,row){
            var tax = '0' ;
            var subtotal = row.price * row.quantity ;
            // -----------------discount-----------------------
            var ds = row.discount;
            if(ds){
                if (ds.indexOf('%') !== -1) {
                var pds = ds.split('%');
                if (!isNaN(pds[0])) {
                    discount = parseFloat((row.price * parseFloat(pds[0])) / 100);
                    subtotal = subtotal-discount*row.quantity;
                } 
            }
            else{
                subtotal = (subtotal)-ds;
            }
            }
            totalitem++;
            $("#total_item").text(totalitem);
            total += row.price * row.quantity    
            // --------------------discount the end--------------------
            $('#poTable tbody').append("<tr>"+
                "<td>"+'<input name="product_row[]" type="hidden" class="rid" value="' + index +'">'
                +row.name+"</td>"
                +'<td class="rec_con">'+row.price+'</td>'
                +'<td class="rec_con"><input class="form-control text-center quantity" name="product_quantity[]" type="text" value="' +row.quantity+'" onClick="this.select();"></td>'
                +
                // '<td class="rec_con"><input class="form-control text-center discount" id="discount" name="product_discount[]" type="text" value="' +row.discount+'" onClick="this.select();"></td>'
                // +
                '<td class="rec_con">'+subtotal+'</td>'
                +'<td class="delete">'+'<i class="fas fa-trash"></i>'+"</td>"
                +"</tr>"
                +'<input name="product_id[]" type="hidden" class="product_id" value="' + row.value +'">'
                +'<input name="product_code[]" type="hidden" class="product_code" value="' + row.code +'">'
                +'<input name="product_name[]" type="hidden" class="product_name" value="' + row.name +'">'
                +'<input name="product_price[]" type="hidden" class="product_price" value="' + row.price +'">'
                +'<input name="product_subtotal[]" type="hidden" class="product_subtotal" value="' + subtotal +'">'
                +'<input name="total" type="hidden" class="total" value="' + total +'">')
            })
            grand_total += total;
            $("#grand_total").text(parseFloat(grand_total).toFixed(2));
    };

    $(document).ready(function(){
        $( "#product_search" ).autocomplete({
        source: function( request, response ) {
            $.ajax({
            url:"/api/product/all",
            type: 'post',
            dataType: "json",
            data: {
                search: request.term
            },
            success: function( data ) {
                response( data );
            }
            });
        },
        select: function (event, ui) {
                if (ui.item.id !== 0) {
                    var row = add_item_list(ui.item);
                    if (row)
                    $(this).val('');
                } else {
                    bootbox.alert('no_match_found');
                }
            return false;
        }
        });
    });
    function add_item_list(item) {
        add_item = JSON.parse(localStorage.getItem('product'));
        langdata = add_item ? add_item.length : '';
            if(langdata == 0){
                add_item = {};
            }
            add_item[new Date().getTime()] = item;
            localStorage.setItem('product', JSON.stringify(add_item));
            loadItems();
        return true;
    }
    $(document).on('click', '.product_id', function () {
        var id = $(this).val();
        $.ajax({
            url:"/api/pos/where/"+id,
            type: 'get',
            dataType: "json",
            cache: false,
            success: function(data) {
            add_item = JSON.parse(localStorage.getItem('product'));
            langdata = add_item ? add_item.length : '';
                if(langdata == 0){
                    add_item = {};
                }
                add_item[new Date().getTime()] = data;
                localStorage.setItem('product', JSON.stringify(add_item));
                loadItems();
            },
        });
    });
    $(document).on('click', '#ppdiscount', function () {
        $('#dsModal').modal('show');
    });
</script>
@endpush
<div class="col-md-12 row">
{{-- Form add category --}}

{{-- end --}}
  <div class="col-md-5">
        <div class="card">
            <div class="card-body" style="background: #a9a9a97a;">
            <form action="/purchases/store" method="POST" enctype="multipart/form-data">
                    @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div >
                            <select class="form-control" id="warehouse" name="warehouse">
                                <option selected disabled>Select Warehouse</option>
                                {{-- <option value="{{$warehouse[0]->id}}">{{$warehouse[0]->name}}</option> --}}
                                @foreach ($warehouse as $row)
                                    <option value="{{$row->id}}">{{$row->name}}</option>
                                @endforeach
                            </select>
                            @error('warehouse')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div style="margin-top: 10px;">
                            <select class="form-control" id="customer" name="customer">
                                <option selected disabled>Select Customer</option>
                                {{-- <option value="{{$customer[0]->id}}">{{$customer[0]->name}}</option> --}}
                                @foreach ($customer as $row)
                                    <option value="{{$row->id}}">{{$row->name}}</option>
                                @endforeach
                            </select>
                            @error('customer')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-top: 10px;">
                    <div class="col-md-12" >
                        <div class="well well-sm">
                            <div class="form-group" style="margin-bottom:8px;">
                                <div class="input-group wide-tip">
                                    <div class="input-group-addon" style="padding-left: 10px; padding-right: 10px;">
                                        <i class="fa fa-2x fa-barcode addIcon"></i></div>
                                        <input class="form-control" type="text" id='product_search' placeholder="Please add products to order list">
                                    <div class="input-group-addon" style="padding-left: 10px; padding-right: 10px;">
                                    <a href="/product/create" id="addManually1" tabindex="-1"><i class=" fa fa-2x fa-plus-circle addIcon" style="color: #36b9cc"></i></a></div>
                                </div>
                            </div>
                        </div>
                        <div class="control-group table-group">
                            <div class="controls table-controls">
                                <table id="poTable" class="  table items table-striped table-bordered">
                                    <thead>
                                    <tr class="text-center bg-gradient-info" style="color: white" >
                                        <th style="width: 40%">Product</th>
                                        <th style="width: 15%">Price</th>
                                        <th style="width: 15%" >Qty</th>
                                        {{-- <th style="width: 9%">Discount</th>                                             --}}
                                        <th style="width: 1%">Total</th>
                                        <th style="width: 1% !important;" id="remove"><i class="fas fa-trash"></i></th>
                                    </tr>
                                    </thead>
                                    <tbody id="tbody">
                                    </tbody>
                                </table>
                                <table  class="table items table-striped table-bordered"  style="margin-top: 5px;">
                                    <tbody>
                                        <tr>
                                            <td style="padding: 5px 10px;border-top: 1px solid #DDD;">Items</td>
                                            <td class="text-center" style="padding: 5px 10px;font-size: 14px; font-weight:bold;border-top: 1px solid #DDD;">
                                                <span id="total_item">0</span>
                                            </td>
                                            <td style="padding: 5px 10px;border-top: 1px solid #DDD;">Total</td>
                                            <td class="text-center" colspan="2" style="padding: 5px 10px;font-size: 14px; font-weight:bold;border-top: 1px solid #DDD;">
                                                <span id="grand_total">0.00</span>
                                            </td>
                                        </tr>
                                        <tr>
                                        
                                        <td id="ppdiscount" colspan="2" style="padding: 5px 10px">
                                                    Discount <i class="fa fa-edit"></i>
                                        </td>
                                            <td colspan="3" class="text-center" style="padding: 5px 10px;font-weight:bold;">
                                                <span id="tds">0.00</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="row" style="margin-top: 5px;">
                                    <div class="col-md-4">
                                        <div class="btn-group-vertical btn-block">
                                            <button type="button" class="btn btn-warning btn-block btn-flat" id="suspend" tabindex="-1">
                                                Suspend                                                </button>
                                            <button type="button" class="btn btn-danger btn-block btn-flat" id="reset" tabindex="-1">
                                                Cancel                                                </button>
                                        </div>
                                    </div>
                                    <div class="col-md-4" style="padding: 0;">
                                        <div class="btn-group-vertical btn-block">
                                            <button type="button" class="btn btn-info btn-block" id="print_order" tabindex="-1">
                                                Order                                                </button>
                                            <button type="button" class="btn btn-primary btn-block" id="print_bill" tabindex="-1">
                                                Bill                                                </button>
                                        </div>
                                    </div>
                                    <div class="col-md-4" >
                                        <button type="button" class="btn btn-success btn-block" id="payment" style="height:75px;" tabindex="-1">
                                            <i class="fa fa-money" style="margin-right: 5px;"></i>Payment                                            </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
        <div class="col-md-7">
            <div class="card" id="productget">
                <div class="card-body" style="width: 800px;">
                    <div id="ajaxproducts">
                        <div id="item-list" style="height: 228px; min-height: 515px;">
                    @foreach ($product as $row)
                                <button class="product_id" value="{{$row->id}}"  type="button" style="margin-top: 5px;max-height: 105px;min-width: 100px;max-width: 100px;">
                                    @if ($row->photo)
                                    <img src="/upload/product/{{$row->photo}}" width="80px" height="80px" alt="combo-test1" class="img-rounded">
                                    @else 
                                    <img src="/upload/no_image.jpg" alt="" width="80px" height="80px">
                                    @endif
                                    <div>{{$row->name}}</div>
                                </button>
                    @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
@endsection

