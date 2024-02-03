@extends('layouts.backend.app',[
    'title' => ' Add Issue ',
    'pageTitle' => ' Add Issue',
])
@section('production-active', 'active')
@section('add_issue', 'active')
@section('production', 'show')
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
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.12.4.js"></script>
  <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
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
    function loadItems() {
        $('#poTable tbody').empty();
            var storage = JSON.parse(localStorage.getItem('product'));
            $.each(storage,function(index,row){
            $('#poTable tbody').append("<tr>"+
                "<td>"+'<input name="product_row[]" type="hidden" class="rid" value="' + index +'">'
                +row.name+" ( "+row.code+" ) </td>"
                +'<td class="rec_con"><input class="form-control text-center quantity" name="product_quantity[]" type="text" value="' +row.quantity+'" onClick="this.select();"></td>'
                +'<td class="rec_con" hidden><input class="form-control text-center photo" name="product_photo[]" type="text" value="' +row.photo+'" onClick="this.select();"></td>'
                +'<td class="rec_con text-center">'+row.type+'</td>'
                +'<td class="delete">'+'<i class="fas fa-trash"></i>'+"</td>"
                +"</tr>"
                +'<input name="product_id[]" type="hidden" class="product_id" value="' + row.value +'">'
                +'<input name="product_code[]" type="hidden" class="product_code" value="' + row.code +'">'
                +'<input name="product_type[]" type="hidden" class="product_type" value="' + row.type +'">'
                +'<input name="product_name[]" type="hidden" class="product_name" value="' + row.name +'">'
                )
            }) 
    };
    $("#remove").click(function(){
        localStorage.removeItem('product');
        loadItems()
    });
    $(document).ready(function(){
        $( "#row_search" ).autocomplete({
        source: function( request, response ) {
            $.ajax({
            url:"/api/product/issue",
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
    <form action="/issue/store" method="POST" enctype="multipart/form-data">
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
    </div>
    <div class="col-md-12 row">
        <div class="col-md-12">
            <div class="well well-sm">
                <div class="form-group" style="margin-bottom:8px;">
                    <div class="input-group wide-tip">
                        <div class="input-group-addon" style="padding-left: 10px; padding-right: 10px;">
                            <i class="fa fa-2x fa-barcode addIcon"></i></div>
                            <input class="form-control" type="text" id='row_search' placeholder="Please add row to order list">
                        <div class="input-group-addon" style="padding-left: 10px; padding-right: 10px;">
                        <a href="/product/create" id="addManually1" tabindex="-1"><i class=" fa fa-2x fa-plus-circle addIcon" style="color: #36b9cc"></i></a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <div class="col-md-12 row">
            <div class="col-md-12">
                <div class="control-group table-group">
                    <label class="table-label">Row</label>
                    <div class="controls table-controls">
                    <table id="poTable" class=" bg-gradient-info table items table-striped table-bordered">
                        <thead>
                        <tr class="text-center" style="color: white" >
                            <th class="col-md-4">Product (Code - Name)</th>
                            <th style="width: 10%">Quantity</th>
                            <th style="width: 10%">type</th>
                            <th style="width: 10%" hidden>photo</th>
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
    <div class="form-group">
        <label for="note">Note</label>
        <textarea class="form-control" id="note" rows="5"style="
        height: 125px;" name="note">{{old('note')}}</textarea>
        @error('note')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
    <button type="submit" class="btn btn-primary ">Add issue</button>
    <a href="/issue" class="btn btn-secondary ">Cancel</a>
    </form>
    </div>
</div>
@endsection
