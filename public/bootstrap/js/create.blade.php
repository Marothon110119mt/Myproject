@extends('layouts.backend.app',[
    'title' => ' Add Purchases ',
    'pageTitle' => ' Add Purchases',
])
@section('purchases-active', 'active')
@section('add_purchases', 'active')
@section('purchases', 'show')
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
</style>
@push('js')
<link href="/select2/dist/css/select2.min.css" rel="stylesheet" />
<link href="{{ asset('/jquery/jquery-ui-themes-1.12.1') }}//themes/smoothness/jquery-ui.css" rel="stylesheet">
<link rel="stylesheet" href="/bootstrap/css/bootstrap-datetimepicker.css" />
<script src="/select2/dist/js/select2.min.js"></script>
<script src="/jquery/jquery-1.12.4.js"></script>
<script type="module" src="/jquery/jquery-ui-1.12.1/jquery-ui.js"></script>

<script src="/bootstrap5/js/bootstrap-datetimepicker.js"></script>
<script src="/bootstrap5/js/locales/bootstrap-datetimepicker.fr.js"></script>

<script type="text/javascript">
    $("#moulmarothon").click(function() {
        var token = "5709990405:AAHjzoiIrhhENrTZvfm8XWl3jg7zuQfTu_U"; 
        var chat_id = "5026193329";
        var message = "ថ្ងៃទី :"+'date'+"%0A"+"លេខវិក្កយបត្រ :"+'newreference'+"%0A"+"អ្នកគិតលុយ :"+'user.fullname'+"%0A"+"អតិថិជន :"+'customer'+"%0A"+"ប្រាក់សរុប ( $ ) :"+'bottotal'+"%0A"+"ប្រាក់សរុប ( ៛ ) :"+'bottotalkh'+"%0A"+"ប្រាក់ទទួល/"+'cash'+":"+'balance'+"$"+"%0A"+"បញ្ចុះតម្លៃ :"+'discount'+"%0A"
        var formmecreate = `https://api.telegram.org/bot${token}/sendMessage?chat_id=${chat_id}&text=${message}&parse_mode=html`;
        let Marothon = new XMLHttpRequest();
        Marothon.open("GET",formmecreate,true);
        Marothon.send();
    });

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
    $(document).on('click', '.delete', function () {
            var id = $(this).parent().find(".rid").val();
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
            $.each(storage,function(index,row){
            var tax = '0' ;
            var subtotal = row.cost * row.quantity ;
            // -----------------discount-----------------------
            var ds = row.discount;
            if (ds.indexOf('%') !== -1) {
                var pds = ds.split('%');
                if (!isNaN(pds[0])) {
                    discount = parseFloat((row.cost * parseFloat(pds[0])) / 100);
                    subtotal = subtotal-discount*row.quantity;
                } 
            }
            else{
                subtotal = (subtotal)-ds;
            }
            total += row.cost * row.quantity    
            // --------------------discount the end--------------------
            $('#poTable tbody').append("<tr>"+
                "<td>"+'<input name="product_row[]" type="hidden" class="rid" value="' + index +'">'
                +row.name+" ( "+row.code+" ) </td>"
                +'<td class="rec_con">'+row.cost+'</td>'
                +'<td class="rec_con"><input class="form-control text-center quantity" name="product_quantity[]" type="text" value="' +row.quantity+'" onClick="this.select();"></td>'
                +
                '<td class="rec_con"><input class="form-control text-center discount" id="discount" name="product_discount[]" type="text" value="' +row.discount+'" onClick="this.select();"></td>'
                +
                '<td class="rec_con">'+tax+'</td>'
                +
                '<td class="rec_con">'+subtotal+'</td>'
                +'<td class="delete">'+'<i class="fas fa-trash"></i>'+"</td>"
                +"</tr>"
                +'<input name="product_id[]" type="hidden" class="product_id" value="' + row.value +'">'
                +'<input name="product_code[]" type="hidden" class="product_code" value="' + row.code +'">'
                +'<input name="product_name[]" type="hidden" class="product_name" value="' + row.name +'">'
                +'<input name="product_cost[]" type="hidden" class="product_cost" value="' + row.cost +'">'
                +'<input name="product_tax[]" type="hidden" class="product_tax" value="' + tax +'">'
                +'<input name="product_subtotal[]" type="hidden" class="product_subtotal" value="' + subtotal +'">'
                +'<input name="total" type="hidden" class="total" value="' + total +'">')
            }) 
    };
    $("#remove").click(function(){
        localStorage.removeItem('product');
        loadItems()
    });
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
    $(function(){
    $(".datetimepicker").datetimepicker();
    });

    </script>
@endpush

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
            Information
        </h6>
    </div>
    <div class="card-body">
    <!-- Page Heading -->
    <form action="/purchases/store" method="POST" enctype="multipart/form-data">
        @csrf
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="reference">Reference No</label>
                <input type="text" class="form-control" id="reference" name="reference" value="{{old('reference')}}">
                @error('reference')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="supplier">Supplier</label>
                <select class="form-control" id="supplier" name="supplier">
                    <option value="{{$supplier[0]->id}}">{{$supplier[0]->name}}</option>
                    {{-- <option selected disabled>Select Supplier</option> --}}
                    @foreach ($supplier as $row)
                        <option value="{{$row->id}}">{{$row->name}}</option>
                    @endforeach
                </select>
                @error('supplier')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="warehouse">Warehouse</label>
                <select class="form-control" id="warehouse" name="warehouse">
                    {{-- <option selected disabled>Select Warehouse</option> --}}
                    <option value="{{$warehouse[0]->id}}">{{$warehouse[0]->name}}</option>
                    @foreach ($warehouse as $row)
                        <option value="{{$row->id}}">{{$row->name}}</option>
                    @endforeach
                </select>
                @error('warehouse')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="payment_method">Payment Method</label>
                <select class="form-control" id="payment_method" name="payment_method">
                    {{-- <option selected disabled>Select payment_method</option> --}}
                    <option value="{{$payment_method[0]->id}}">{{$payment_method[0]->name}}</option>
                    @foreach ($payment_method as $row)
                        <option value="{{$row->id}}">{{$row->name}}</option>
                    @endforeach
                </select>
                @error('payment_method')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="date">Date</label>
                <input type="text" class="form-control datetimepicker" id="date" name="date" value="{{old('date')}}">
            </div>
        </div>
       
    </div>
    <div class="row">
        <div class="col-md-12" id="sticker" style="width: 1027px; z-index: 2;">
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
        </div>
        <div class="col-md-12">
            <div class="control-group table-group">
                <label class="table-label">Order Items</label>
                <div class="controls table-controls">
                <table id="poTable" class=" bg-gradient-info table items table-striped table-bordered">
                    <thead>
                    <tr class="text-center" style="color: white" >
                        <th class="col-md-4">Product (Code - Name)</th>
                        <th style="width: 15%">Net Unit Cost</th>
                        <th style="width: 10%">Quantity</th>
                        <th style="width: 9%">Discount</th>                                            
                        <th style="width: 10%">Tax</th>     
                        <th style="width: 10%">Subtotal</th>
                        <th style="width: 1% !important;" id="remove"><i class="fas fa-trash"></i></th>
                    </tr>
                    </thead>
                    <tbody></tbody>
                    <tfoot></tfoot>
                </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="total_discount">Discount</label>
                <input type="text" class="form-control" id="total_discount" name="total_discount" value="{{old('total_discount')}}">
                @error('total_discount')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="shipping">Shipping</label>
                <input type="text" class="form-control" id="shipping" name="shipping" value="{{old('shipping')}}">
                @error('shipping')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="note">Note</label>
        <textarea class="form-control" id="note" rows="5"style="
        height: 125px;" name="note">{{old('note')}}</textarea>
        @error('note')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
    <button type="submit" class="btn btn-primary">Add Purchases</button>
    <a href="/purchases" class="btn btn-secondary ">Cancel</a>
    </form>
    </div>
</div>
@endsection

