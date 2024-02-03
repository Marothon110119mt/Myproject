@extends('layouts.backend.pos',[
    'title' => 'POS',
])

@section('content')
<style>
    .cashcount{
        background-color: red;font-weight: 700;color: #ffffff;position: absolute;font-size: 15px;l-height: 10px;top: 0;right: 10px;height: 15px;width: 17px;text-align: center;
    }
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
    #productget {
    overflow-x: hidden;
    display: block;
    width: 800px;
    height: 650px;
    }
    .input-group-btn {
        line-height: 35px;
    }
    option {
        font-size: 18px;
        background-color: #ffffff;
    }
    .Marothon {
        text-align: center;
        display: inline-block;
        cursor: pointer;
        border: 1px solid #f1f1f1;
        background: white;
    }
    .category-btn{
        text-align: center;
        display: inline-block;
        cursor: pointer;
        border: 1px solid #f1f1f1;
        overflow-x: hidden;
    }
    .col-xs-3 {
        width: 25%;
    }
    .col-xs-2 {
        width: 24.3%;
        background: white;
    }
    #product_img {
        max-height: 80px;
        max-width: 100px;
    }
    #product_name {
        height: 30px;
        overflow: hidden;
        border-bottom: 1px solid #f1f1f1;
    }
    .ui-menu-item{
        white-space: nowrap; 
        text-overflow: ellipsis;
        max-width: 300px;
        overflow: hidden;
    }
    #category-slider, #subcategory-slider, #brands-slider {
        display: none;
        z-index: 1060;
        height: 85%;
        position: absolute;
        top: 10%;
        right: 0;
        width: 540px;
        border: 1px solid #d8d8d8;
        background: #fff;
        padding: 10px 10px;
    }
    .btn-prni span {
        display: table-cell;
        height: 45px;
        line-height: 15px;
        vertical-align: middle;
        text-transform: uppercase;
        width: 10.5%;
        min-width: 94px;
        overflow: hidden;
    }
    .btn-prni.active {
        background: #00bcce30;
        border: 1px solid #e5e5e5;
        cursor: default;
    }
    .slider-get{
        overflow-x: hidden;
        display: block;
        height: 94%;
    }
    .get_name{
        white-space: nowrap; 
        text-overflow: ellipsis;
        max-width: 100px;
        overflow: hidden;
    }
    .table td{
        padding: 0.25rem;
        vertical-align: middle;
    }
</style>
@push('js')

<script type="text/javascript">
    let audio1 = new Audio();
    audio1.src="assets/images/PAYMENTS.m4a" 
    let audio = new Audio();
    audio.src="assets/images/pop.mp3"
    var data = {!! json_encode($product->toArray()) !!}
    if(localStorage.getItem('product')){
        localStorage.removeItem('product');
        loadItems()
    let dotInterval = setInterval(function () { $(".dot").text('.') }, 3000);
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
    $("#reset").click(function(){
        $('#total_item').text('0');
        localStorage.removeItem('product');
        loadItems()
    });
    $(document).on('click', '.delete', function () {
            var id = $(this).parent().find(".rid").val();
            console.log(id);
            $('#total_item').text('0');
            var storage = JSON.parse(localStorage.getItem('product'));
            delete storage[id];
            localStorage.setItem('product', JSON.stringify(storage));
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
            let discount_total = 0;
            let final_total = 0;
            var totalitem = 0;
            var item_total = 0;
            $.each(storage,function(index,row){
            var tax = '0' ;
            var subtotal = parseFloat(row.price * row.quantity).toFixed(2)
            // -----------------discount-----------------------
            var ds = row.discount;
            totalitem++;
            $("#total_item").text(totalitem);
            total += row.price * row.quantity    
            // --------------------discount the end--------------------
            $('#poTable tbody').append("<tr>"+
                "<td class='get_name'>"+'<input name="product_row[]" type="hidden" class="rid" value="' + index +'">'
                +row.name+"</td>"
                +'<td class="rec_con">'+row.price+'</td>'
                +'<td class="rec_con"><input class="form-control text-center quantity" name="product_quantity[]" type="text" value="' +row.quantity+'" onClick="this.select();" style="padding: 0px"></td>'
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
            discount_total = $('#tddiscount').text();
            if(discount_total){
                if (discount_total.indexOf('%') !== -1) {
                    var pds = discount_total.split('%');
                    if (!isNaN(pds[0])) {
                        discount = parseFloat((grand_total * parseFloat(pds[0])) / 100);
                        final_total = parseFloat(grand_total-discount).toFixed(2)
                    } 
                }
                else{
                    final_total = parseFloat(grand_total-discount_total).toFixed(2)
                }
            }
            $("#grand_total").text(final_total);
            localStorage.setItem('discount',discount_total);
            localStorage.setItem('total',final_total);
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
            if($("#warehouse").val() != null && $("#customer").val() != null){
                if (ui.item.id !== 0) {
                    var row = add_item_list(ui.item);
                    if (row)
                    $(this).val('');
                } else {
                    alert('no_match_found');
                }
            }else{
                alert('Please Select Abrove First');

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

    $(document).on('click', '.ui-menu-item', function () {
        let audio = new Audio();
            audio.src="assets/images/pop.mp3"
        audio.play();
    });
    $(document).on('click', '.product_id', function () {
        var id = $(this).val();
        if($("#warehouse").val() != null && $("#customer").val() != null){
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
        }else{
                alert('Please Select Abrove First');

            }
    });
    $("#total_paying").on('input', function () {
            $(this).calculateChange();
    });
    $("#total_paying_khmer").on('input', function () {
            $(this).calculateChange();
    });
    $.fn.calculateChange = function () {
        loadmethod();
        $(".method").val($("#method").val());
        $(".total_item").val($("#total_item").text());
        var change = $("#payablePrice").val() - $("#total_paying").val()-($("#total_paying_khmer").val()/4100);
        if(change <= 0){
            $("#balance").text(change.toFixed(2));
            $("#balancekhmer").text((change*4100).toFixed(0));
            $(".tddiscount").val($("#tddiscount").text());
            $(".balance").val($("#balance").text());
            $(".balancekhmer").val($("#balancekhmer").text());
        }else{
            $("#balance").text(change.toFixed(2));
            $("#balancekhmer").text((change*4100).toFixed(0)); 

            $(".balance").val($("#balance").text());
            $(".balancekhmer").val($("#balancekhmer").text());
            $(".tddiscount").val($("#tddiscount").text());
        }
        if(change <= 0){
            $("#confirmPayment").show();
            $("#textofchange").text('Change');
        }else{
            $("#textofchange").text('Balance');
            $("#confirmPayment").hide();
        }
    }
    var checkfocus;
    const form = document.getElementById('total_paying_khmer');
        form.addEventListener('focus', (event) => {
            checkfocus = 'total_paying_khmer';
        }, true);
        const form1 = document.getElementById('total_paying');
        form1.addEventListener('focus', (event) => {
            checkfocus = 'total_paying';
        }, true);
    $.fn.go = function (value) {
        if(checkfocus=='total_paying_khmer'){
            $("#total_paying_khmer").val($("#total_paying_khmer").val()+""+value);
        }else{
            $("#total_paying").val($("#total_paying").val()+""+value);
        }
        $(this).calculateChange();
    }
    $.fn.delete = function (value) {
        if(checkfocus=='total_paying_khmer'){
            $('#total_paying_khmer').val($('#total_paying_khmer').val().substr(0,$('#total_paying_khmer').val().length -1))
        }else{
            $('#total_paying').val($('#total_paying').val().substr(0,$('#total_paying').val().length -1))
        }
        $(this).calculateChange();
    }
    $.fn.digits = function(){
        if(checkfocus=='total_paying_khmer'){
            $("#total_paying_khmer").val($("#total_paying_khmer").val()+".");
        }else{
            $("#total_paying").val($("#total_paying").val()+".");
        }
        $(this).calculateChange();
    }
    $("#ppdiscount").click(function(){
            $('#modal_discount').modal('show')
    });
    $("#updateOrderDiscount").click(function(){
        $('#tddiscount').text($('#order_discount_input').val())
        loadItems()
        $('#modal_discount').modal('hide')
        $(this).calculateChange();
    });
    $("#payment").click(function(){
        loadmethod();
        $('#payablePrice').val($('#grand_total').text())
        $('#payablePricekhmer').val($('#grand_total').text()*4100)
        $('#balancekhmer').text($('#grand_total').text()*4100)
        $('#balance').text($('#grand_total').text())
        $('#paymentModel').modal('show')
    });
 
    $("#aba").on('click', function (x) {
        $("#method").val('1').change();
    });
    $("#acleda").on('click', function (x) {
        $("#method").val('3').change();
    });
    $("#wing").on('click', function (x) {
        $("#method").val('4').change();
    });
    $("#foodpanda").on('click', function (x) {
        $("#method").val('7').change();
    });
    $(".cashtype").on('click', function (x) {
        $(this).find('.cashcount').text($(this).find('.cashcount').text()*1+1);
        $(this).find('.cashcount').show();
    });
    $(".clear").on('click', function (x) { 
        $(".cashcount").text('');
        $(".cashcount").hide();
        $('#payment').val('');
        $('#total_paying').val('');
        $('#total_paying_khmer').val('');
        $(this).calculateChange();
    });
    function loadmethod() { 
        $.get('/api/pos/payment_method', function (payment_method) {
            payment_method.forEach(cust => {
                let methods = `<option value='${cust.id}'>${cust.name}</option>`;
                $('#method').append(methods);
            });
        });
    }
    let $search = $("#search").on('input',function(){
        searchProducts();       
    });
    function searchProducts () {        
        var matcher = new RegExp($("#search").val(), 'gi');
        $('.box').show().not(function(){
            return matcher.test($(this).find('.name, .sku').text())
        }).hide();
    }

    $('.open-brands').click(function() {
        $('#brands-slider').toggle('slide', { direction: 'right' }, 700);
    });
    $('.open-category').click(function() {
        $('#category-slider').toggle('slide', { direction: 'right' }, 700);
    });
    $('.open-subcategory').click(function() {
        $('#subcategory-slider').toggle('slide', { direction: 'right' }, 700);
    });
    $(document).on('click', function(e) {
        if (
            !$(e.target).is('.open-brands, .cat-child') &&
            !$(e.target)
                .parents('#brands-slider')
                .size() &&
            $('#brands-slider').is(':visible')
        ) {
            $('#brands-slider').toggle('slide', { direction: 'right' }, 700);
        }
        if (
            !$(e.target).is('.open-category, .cat-child') &&
            !$(e.target)
                .parents('#category-slider')
                .size() &&
            $('#category-slider').is(':visible')
        ) {
            $('#category-slider').toggle('slide', { direction: 'right' }, 700);
        }
        if (
            !$(e.target).is('.open-subcategory, .cat-child') &&
            !$(e.target)
                .parents('#subcategory-slider')
                .size() &&
            $('#subcategory-slider').is(':visible')
        ) {
            $('#subcategory-slider').toggle('slide', { direction: 'right' }, 700);
        }
    });

    $(document).on('click', '.category', function () {
       $('#parent').empty().append();
       $('#item-list').hide();
        var cat_id;
        $('.category').removeClass('active');
        if (cat_id != $(this).val()) {
            $('#open-category').click();
            cat_id = $(this).val();
           $.ajax({
                url: '/api/pos/category/'+cat_id,
                type: 'GET',
                data: JSON.stringify(cat_id),
                contentType: 'application/json; charset=utf-8',
                cache: false,
                processData: false,
                success: function (product) {
                    product.forEach(item => {
                    if(item.photo){
                        var linkimg  = '/upload/product/'+item.photo;
                    }
                    else{
                        var linkimg  = '/upload/no_image.jpg';
                    }
                    let item_info = `
                    <button class="product_id Marothon row col-xs-3 box" style="outline: none;margin-right: 8.5px;min-height: 162px;" value="${item.id}" onclick="audio.play()"  type="button">
                        <img  src="${linkimg}" id="product_img" alt="">
                        <div class="text-muted  text-center">
                            <div class="name" id="product_name">${item.name}</div> 
                            <span class="sku">${item.code}</span>
                            <input class="product_where" hidden value="${item.id}"/>
                            <span class="count">/ ${item.quantity > 1 ? item.quantity : 'N/A'}</span>
                        </div>
                        <span class="text-success text-center"><b data-plugin="counterup">${item.price}$</b> </span>
                    </button>`;
                    $('#parent').append(item_info);
                });
                }
            });
            $('#category-' + cat_id).addClass('active');
        }
    });
    $(document).on('click', '.brand', function () {
       $('#parent').empty().append();
       $('#item-list').hide();
        var cat_id;
        $('.brand').removeClass('active');
        if (cat_id != $(this).val()) {
            $('#open-brands').click();
            cat_id = $(this).val();
           $.ajax({
                url: '/api/pos/brand/'+cat_id,
                type: 'GET',
                data: JSON.stringify(cat_id),
                contentType: 'application/json; charset=utf-8',
                cache: false,
                processData: false,
                success: function (product) {
                    product.forEach(item => {
                    if(item.photo){
                        var linkimg  = '/upload/product/'+item.photo;
                    }
                    else{
                        var linkimg  = '/upload/no_image.jpg';
                    }
                    let item_info = `
                    <button class="product_id Marothon row col-xs-3 box" style="outline: none;margin-right: 8.5px;min-height: 162px;" value="${item.id}" onclick="audio.play()"  type="button">
                        <img  src="${linkimg}" id="product_img" alt="">
                        <div class="text-muted  text-center">
                            <div class="name" id="product_name">${item.name}</div> 
                            <span class="sku">${item.code}</span>
                            <input class="product_where" hidden value="${item.id}"/>
                            <span class="count">/ ${item.quantity > 1 ? item.quantity : 'N/A'}</span>
                        </div>
                        <span class="text-success text-center"><b data-plugin="counterup">${item.price}$</b> </span>
                    </button>`;
                    $('#parent').append(item_info);
                });
                }
            });
            $('#brand-' + cat_id).addClass('active');
        }
    });
    
</script>
@endpush
<form action="/pos/store" method="POST" enctype="multipart/form-data">
    @csrf
<div class="col-md-12 row">
  <div class="col-md-5" style="margin-left: -20px;">
  {{-- <div class="col-md-5"> --}}
        <div class="card">
            <div class="card-body" style="background: white;">
                <div class="row">
                    <div class="col-md-12">
                        <div >
                            <select class="form-control" id="warehouse" name="warehouse" >
                                {{-- <option selected disabled>Select Warehouse</option> --}}
                                <option value="{{$warehouse[0]->id}}">{{$warehouse[0]->name}}</option>
                                @foreach ($warehouse as $row)
                                @if ($row->id != $warehouse[0]->id)
                                    <option  value="{{$row->id}}">{{$row->name}}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                        <div style="margin-top: 10px;">
                            <select class="form-control" id="customer" name="customer">
                                {{-- <option selected disabled>Select Customer</option> --}}
                                <option value="{{$customer[0]->id}}">{{$customer[0]->name}}</option>
                                @foreach ($customer as $row)
                                @if ($row->id != $customer[0]->id)
                                    <option  value="{{$row->id}}">{{$row->name}}</option>
                                @endif
                                @endforeach
                            </select>
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
                                        <input class="form-control" id='product_search' placeholder="Please add products to order list">
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
                                            <td  colspan="2" style="padding: 5px 10px">
                                                        Discount <i id="ppdiscount" class="fa fa-edit" style="color: #0014ff85;"></i>
                                            </td>
                                                <td colspan="3" class="text-center" style="padding: 5px 10px;font-weight:bold;">
                                                    <span id="tddiscount" value="">0.00</span>
                                                   <input hidden class="tddiscount"  name="discount" value="" >
                                                </td>
                                            </tr>
                                        <tr>
                                            <td style="padding: 5px 10px;border-top: 1px solid #DDD;">Items</td>
                                            <td class="text-center" style="padding: 5px 10px;font-size: 14px; font-weight:bold;border-top: 1px solid #DDD;">
                                                <span id="total_item">0</span>
                                                <input hidden class="total_item" value="" name="total_item"/>
                                            </td>
                                            <td style="padding: 5px 10px;border-top: 1px solid #DDD;">Total</td>
                                            <td class="text-center" colspan="2" style="padding: 5px 10px;font-size: 14px; font-weight:bold;border-top: 1px solid #DDD;">
                                                <span id="grand_total" value="">0.00</span>
                                            </td>
                                        </tr>
                                    
                                    </tbody>
                                </table>
                                <div class="row" style="margin-top: 5px;">
                                    <div class="col-md-4">
                                        <div class="btn-group-vertical btn-block">
                                            <a href="/dashboard" type="button" class="btn btn-warning btn-block btn-flat" id="dashboard" tabindex="-1">
                                                <i class="fas fa-fw fa-tachometer-alt"></i><span class="padding05">Dashboard</span>
                                            </a>
                                            <button type="button" class="btn btn-danger btn-block btn-flat" id="reset" tabindex="-1">
                                                <i class="fas fa-trash"></i>Cancel                                                
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-md-4" style="padding: 0;">
                                        <div class="btn-group-vertical btn-block">
                                            <button type="button" class="btn btn-info btn-block" id="print_order" tabindex="-1">
                                                <i class="fas fa-shopping-basket"></i> Order                                             
                                            </button>
                                            <a href="/pos/custom" target="_blank" type="button" class="btn btn-primary btn-block" id="print_bill" tabindex="-1">
                                                <i class="fas fa-tv"></i> Bill
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-md-4" >
                                        <button type="button" class="btn btn-success btn-block" id="payment" style="height:75px;" tabindex="-1">
                                            <i class="fas fa-money-bill-alt" style="margin-right: 5px;"></i>Payment                                            </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <div class="col-md-7" >
            <div class="card" id="productget" style="width: 800px;background: white;">
                <div class="card-body">
                    <div class="col-md-12 row">
                        <div class="input-group col-xs-3" style="margin-left: 0px;padding-bottom: 10px;">
                                <input type="text" id="search" class="form-control" placeholder="Search  Name  /  Code">
                        </div>
                        <div class="col-md-6">
                                <div style="float: left;padding-right: 10px;">
                                    <button type="button" id="open-category" class="btn btn-primary open-category" tabindex="-1">
                                        Categories
                                    </button>
                                </div>
                                <div style="float: left;">
                                    <button type="button" id="open-brands" class="btn btn-info open-brands" tabindex="-1">
                                        Brands
                                    </button>
                                </div>
                        </div>
                        {{-- <div class="col-md-3">
                                <button type="button" id="open-subcategory" class="btn btn-warning open-subcategory" tabindex="-1">Sub Categories</button>  
                        </div>   --}}
                        {{-- <div class="col-md-3" style="text-align: center">
                                <button type="button" id="open-brands" class="btn btn-info open-brands" tabindex="-1">Brands</button>
                        </div>  --}}
                        
                    </div>

                    <div id="ajaxproducts" style="margin-right: -10px;margin-left: 10px;">
                        <div id="item-list">
                    @foreach ($product as $row)
                    <button class="product_id Marothon row col-xs-3 box" style="outline: none;margin-right: 8.5px;min-height: 162px;" value="{{$row->id}}" onclick="audio.play()"  type="button">
                            @if ($row->photo)
                            <img src="/upload/product/{{$row->photo}}" width="80px" height="80px" alt="combo-test1" class="img-rounded">
                            @else 
                            <img src="/upload/no_image.jpg" alt="" width="80px" height="80px">
                            @endif
                            <div class="text-muted  text-center">
                                <div class="name" id="product_name">{{$row->name}}</div> 
                                <span class="category_where" hidden>{{$row->category}}</span>
                                <span class="sku">{{$row->code}}</span>
                                <span class="count">/ {{$row->quantity > 1 ? $row->quantity : 'N/A'}}</span>
                            </div>
                            <span class="text-success text-center"><b data-plugin="counterup">{{$row->price}}$</b> </span>
                    </button>
                    @endforeach
                        </div>
                        <div id="parent"> 
                      
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
{{-- Form add paymentModel --}}
<div id="paymentModel" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">FINALIZE SALE</h5>
                <span type="button" style="font-size: 20px;" id="Orderdiscount"  class="btn-close close_category" data-bs-dismiss="modal" aria-label="Close">x</span>
            </div>
            <div class="col-md-12 row" style="padding-top: 5px;margin-bottom: 20px;margin-left: 0px;">
                <div class="col-md-5">
                  <div>
                  <img src="assets/images/aba.jpg" alt="" onclick="audio1.play()" id="aba" width="24%">
                  <img src="assets/images/acleda.png" alt="" onclick="audio1.play()" id="acleda" width="24%">
                  <img src="assets/images/wing.png" alt="" onclick="audio1.play()" id="wing" width="24%">
                  <img src="assets/images/foodpanda.webp" alt="" onclick="audio1.play()" id="foodpanda" width="24%">
                </div>
                 {{-- <div class="col-md-12 row"> --}}
                    <div class="col-md-6"  style="padding-top: 5px;float: left;padding-right: 5px;padding-left: 0px;">
                        <div class="cashtype" style="width:100%">
                            <span class="cashcount" style="display: none;margin-top: 5px;line-height: 14px;"></span>    
                            <img src="assets/images/5.jpg" alt="" onclick="$('#total_paying').val($('#total_paying').val()*1+5);audio.play(); $(this).calculateChange();" width="100%" height="82px"><br>
                        </div>
                        <div class="cashtype"  style="width:100%;">
                            <span class="cashcount" style="display: none;margin-top: 91px;line-height: 14px;"></span>    
                            <img src="assets/images/10.jpg" alt="" onclick="$('#total_paying').val($('#total_paying').val()*1+10);audio.play(); $(this).calculateChange();" width="100%" height="82px" style="padding-top: 4px;"><br>
                        </div><div class="cashtype" style="width:100%">
                            <span class="cashcount" style="display: none;margin-top: 174px;line-height: 14px;"></span>    
                            <img src="assets/images/20.jpg" alt="" onclick="$('#total_paying').val($('#total_paying').val()*1+20);audio.play(); $(this).calculateChange();" width="100%" height="82px" style="padding-top: 4px;"><br>
                        </div><div class="cashtype" style="width:100%">
                            <span class="cashcount" style="display: none;margin-top: 255px;line-height: 14px;"></span>       
                            <img src="assets/images/50.jpg" alt="" onclick="$('#total_paying').val($('#total_paying').val()*1+50);audio.play(); $(this).calculateChange();" width="100%" height="82px" style="padding-top: 4px;"><br>
                        </div><div class="cashtype" style="width:100%">
                            <span class="cashcount" style="display: none;margin-top: 337px;line-height: 14px;"></span>    
                            <img src="assets/images/100.jpg" alt="" onclick="$('#total_paying').val($('#total_paying').val()*1+100);audio.play(); $(this).calculateChange();" width="100%" height="82px" style="padding-top: 4px;">
                        </div>
                   </div>
                   <div class="col-md-6" style="padding-top: 5px;float: right;padding-left: 0px;padding-right: 5px;">
                        <div class="cashtype" style="width:100%">
                            <span class="cashcount" style="display: none;margin-top: 5px;line-height: 14px;"></span>    
                            <img src="assets/images/5000.jpg" alt="" onclick="$('#total_paying_khmer').val($('#total_paying_khmer').val()*1+5000);audio.play();$(this).calculateChange();" width="100%" height="82px">
                        </div>
                        <div class="cashtype" style="width:100%">
                            <span class="cashcount" style="display: none;margin-top: 91px;line-height: 14px;"></span>    
                            <img src="assets/images/10000.jpg" alt="" onclick="$('#total_paying_khmer').val($('#total_paying_khmer').val()*1+10000);audio.play(); $(this).calculateChange();" width="100%" height="82px" style="padding-top: 4px;">
                        </div>
                        <div class="cashtype" style="width:100%">
                            <span class="cashcount" style="display: none;margin-top: 174px;line-height: 14px;"></span>    
                            <img src="assets/images/20000.jpg" alt="" onclick="$('#total_paying_khmer').val($('#total_paying_khmer').val()*1+20000);audio.play(); $(this).calculateChange();" width="100%" height="82px" style="padding-top: 4px;">
                        </div>
                        <div class="cashtype" style="width:100%">
                            <span class="cashcount" style="display: none;margin-top: 255px;line-height: 14px;"></span>    
                            <img src="assets/images/50000.jpg" alt="" onclick="$('#total_paying_khmer').val($('#total_paying_khmer').val()*1+50000);audio.play(); $(this).calculateChange();" width="100%" height="82px" style="padding-top: 4px;">
                        </div>
                        <div class="cashtype" style="width:100%">
                            <span class="cashcount" style="display: none;margin-top: 337px;line-height: 14px;"></span>    
                            <img src="assets/images/100000.jpg" alt="" onclick="$('#total_paying_khmer').val($('#total_paying_khmer').val()*1+100000);audio.play(); $(this).calculateChange();" width="100%" height="82px" style="padding-top: 4px;">
                        </div>
                   </div>
              {{-- </div> --}}
            </div>
                  <div class="col-md-7">
                    <div class="row">
                        <div class="col-md-6" style="float: left;">
                        <select id="method" class="form-control" name="paying_by" value="">
                        </select>
                          <br>
                          <div class="input-group" style="margin-top: -15px;">
                              <span class="input-group-btn" id="basic-addon3">Total Paying ( $ )</span>
                              <input type="text" placeholder="0.0" class="form-control" value="" id="total_paying" name="total_paying" aria-describedby="basic-addon3">
                          </div>
                          <br>
                          <div class="input-group" style="margin-top: -15px;">
                              <span class="input-group-btn" id="basic-addon3">Total Paying ( ៛ )</span>
                              <input type="text" placeholder="0.0" class="form-control" value="" id="total_paying_khmer" name="total_paying_khmer" aria-describedby="basic-addon3">
                          </div>
                        </div>
                        <div class="col-md-6" style="float: right;">
                          <div class="input-group">
                              <span class="input-group-btn" id="basic-addon3">Exchange Rate </span>
                              <input id="currencyratekhmer" value=" 1$ = 4100 ៛" readonly="" type="text" class="form-control" aria-describedby="basic-addon3">
                          </div>
                         <br>
                          <div class="input-group" style="margin-top: -15px;">
                              <span class="input-group-btn" id="basic-addon3">Total Payable ( $ )</span>
                              <input id="payablePrice" name="payablePrice" readonly="" value="" type="number" class="form-control" aria-describedby="basic-addon3">
                          </div>
                          <br>
                          <div class="input-group" style="margin-top: -15px;">
                              <span class="input-group-btn" id="basic-addon3">Total Payable ( ៛ )</span>
                              <input id="payablePricekhmer" name="payablePricekhmer" readonly="" value="" type="number" class="form-control" aria-describedby="basic-addon3">
                          </div>
                      </div>
                    </div>
                      <br>
                      <div>
                          <div class="row">
                              <div class="col-md-12">
                                <div class="btn btn-primary btn-block btn-lg waves-effect waves-light"><span id="textofchange">Balance</span> ( <span id="balance" value="">0.00</span>$ )( <span id="balancekhmer" value="">0.00</span>៛ )</div>
                                <input hidden class="balance"  name="balance" value="" >
                                <input hidden class="balancekhmer"  name="balancekhmer" value="" >
                              </div>
                          </div>
                      </div>
                      <br>
                      <div class="row">
                          <div class="col-md-12">
                              <div class="row">
                                  <div class="col-md-4">
                                      <div onclick="$(this).go(1,false);" class="btn btn-success btn-lg btn-block" style="height: 60px; width: 140px;">1</div>
                                  </div>
                                  <div class="col-md-4">
                                      <div onclick="$(this).go(2,false);" class="btn btn-success btn-lg btn-block" style="height: 60px;width: 140px;">2</div>
                                  </div>
                                  <div class="col-md-4">
                                      <div onclick="$(this).go(3,false);" class="btn btn-success btn-lg btn-block" style="height: 60px;width: 130px;">3</div>
                                  </div>
                              </div>
                              <div class="row" style="padding-top: 3px;">
                                  <div class="col-md-4">
                                      <div onclick="$(this).go(4,false);" class="btn btn-success btn-lg btn-block" style="height: 60px;width: 140px;">4</div>
                                  </div>
                                  <div class="col-md-4">
                                      <div onclick="$(this).go(5,false);" class="btn btn-success btn-lg btn-block" style="height: 60px;width: 140px;">5</div>
                                  </div>
                                  <div class="col-md-4">
                                      <div onclick="$(this).go(6,false);" class="btn btn-success btn-lg btn-block" style="height: 60px;width: 130px;">6</div>
                                  </div>
                              </div>
                              <div class="row" style="padding-top: 3px;">
                                  <div class="col-md-4">
                                      <div onclick="$(this).go(7,false);" class="btn btn-success btn-lg btn-block" style="height: 60px;width: 140px;">7</div>
                                  </div>
                                  <div class="col-md-4">
                                      <div onclick="$(this).go(8,false);" class="btn btn-success btn-lg btn-block" style="height: 60px;width: 140px;">8</div>
                                  </div>
                                  <div class="col-md-4">
                                      <div onclick="$(this).go(9,false);" class="btn btn-success btn-lg btn-block" style="height: 60px;width: 130px;">9</div>
                                  </div>
                              </div>
                              <div class="row" style="padding-top: 3px;">
                                  <div class="col-md-4">
                                      <div onclick="$(this).delete(2,false);$(this).calculateChange();" class="btn btn-success btn-lg btn-block" style="height: 60px;width: 140px;">⌫</div>
                                  </div>
                                  <div class="col-md-4">
                                      <div onclick="$(this).go(0,false);" class="btn btn-success btn-lg btn-block" style="height: 60px;width: 140px;">0</div>
                                  </div>
                                  <div class="col-md-4">
                                      <div onclick="$(this).digits()" class="btn btn-success btn-lg btn-block" style="height: 60px;width: 130px;">.</div>
                                  </div>
                              </div>
                              <div class="row" style="padding-top: 3px;">
                                  <div class="col-md-8">
                                          <div class="row">
                                              <div class="col-md-12">
                                                <button type="submit" id="confirmPayment" class="btn btn-block " style="height: 60px; width: 102%; display: none;background-color: #36b9cc;font-size: 20px;color: white;">Confirm payment</button>
                                            </div>
                                          </div>
                                  </div>
                                  <div class="col-md-4">
                              <div type="button" onclick="$('#total_paying').val(0.00);" class="btn btn-danger btn-block btn-lg clear" style="height: 60px">Clear</div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
{{-- end --}}
</form>
{{-- Form add modal_discount --}}
<div class="modal fade" id="modal_discount" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Edit Order Discount</h5>
                <span type="button" style="font-size: 20px;" id="Orderdiscount"  class="btn-close close_category" data-bs-dismiss="modal" aria-label="Close">x</span>
                </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="order_discount_input">Order Discount</label>
                    <input type="text" name="order_discount_input" value="" class="form-control kb-pad ui-keyboard-input ui-widget-content ui-corner-all" id="order_discount_input" aria-haspopup="true" role="textbox">
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" id="updateOrderDiscount" class="btn btn-primary" tabindex="-1">Update</button>
            </div>
        </div>
    </div>
</div>
{{-- end --}}
<div id="category-slider" style="display: none;border-radius: 10px;">
    <h3>Categories</h3>
    <div class="slider-get">
        <div id="category-list" class="ps-container">
            @foreach ($category as $row)
                <button id="category-{{$row->id }}" type="button" value="{{$row->id}}" class="btn-prni category col-xs-2 category-btn rounded-lg shadow" tabindex="-1">
                    @if ($row->photo)
                        <img src="/upload/{{$row->photo}}" width="80px" height="80px" alt="combo-test1" class="img-rounded" style="margin-bottom: 5px;">
                    @else 
                        <img src="/upload/no_image.jpg" alt="" width="80px" height="80px" style="margin-bottom: 5px;">
                    @endif
                    <span style="border-top: 1px solid #bdbdbd;">{{$row->name}}</span>
                </button>
            @endforeach
            <div class="ps-scrollbar-x-rail" style="width: 0px; display: none; left: 0px; bottom: 3px;">
                <div class="ps-scrollbar-x" style="left: 0px; width: 0px;">
                </div>
            </div>
            <div class="ps-scrollbar-y-rail" style="top: 0px; height: 0px; display: none; right: 3px;">
                <div class="ps-scrollbar-y" style="top: 0px; height: 0px;">
                </div>
            </div>
        </div>
    </div>
</div>

<div id="subcategory-slider">
    <div id="subcategory-list" class="ps-container">
        <div class="ps-scrollbar-x-rail" style="width: 0px; display: none; left: 0px; bottom: 3px;">
            <div class="ps-scrollbar-x" style="left: 0px; width: 0px;">
            </div>
        </div>
        <div class="ps-scrollbar-y-rail" style="top: 0px; height: 0px; display: none; right: 3px;">
            <div class="ps-scrollbar-y" style="top: 0px; height: 0px;">
            </div>
        </div>
    </div>
</div>

<div id="brands-slider" style="border-radius: 10px;">
        <h3>Brands</h3>
    <div class="slider-get">
        <div id="brands-list" class="ps-container">
            @foreach ($brand as $row)
                <button id="brand-{{$row->id }}" type="button" value="{{$row->id}}" class="btn-prni brand col-xs-2 category-btn rounded-lg shadow" tabindex="-1">
                    @if ($row->photo)
                        <img src="/upload/{{$row->photo}}" width="80px" height="80px" alt="combo-test1" class="img-rounded" style="margin-bottom: 5px;">
                    @else 
                        <img src="/upload/no_image.jpg" alt="" width="80px" height="80px" style="margin-bottom: 5px;">
                    @endif
                    <span style="border-top: 1px solid #bdbdbd;">{{$row->name}}</span>
                </button>
            @endforeach
            <div class="ps-scrollbar-x-rail" style="width: 0px; display: none; left: 0px; bottom: 3px;">
                <div class="ps-scrollbar-x" style="left: 0px; width: 0px;">
                </div>
            </div>
            <div class="ps-scrollbar-y-rail" style="top: 0px; height: 0px; display: none; right: 3px;">
                <div class="ps-scrollbar-y" style="top: 0px; height: 0px;">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

