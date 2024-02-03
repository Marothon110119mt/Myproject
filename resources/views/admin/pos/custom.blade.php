@extends('layouts.backend.view',[
    'title' => 'POS',
])

@section('content')

<style>
    @import url(https://fonts.googleapis.com/css2?family=Khmer&display=swap);
    
      * {box-sizing: border-box;}
      body {
      background: #ebeff2;
      font-family: 'Noto Sans', 'Helvetica Neue', 'Khmer',Helvetica, Arial, sans-serif;
      margin: 0;
      overflow-x: hidden;
      color: #797979;
    }
      .mySlides {display: none;}
      img {vertical-align: middle;}
      
      /* Slideshow container */
      .slideshow-container {
        /* max-width: 1000px; */
        position: relative;
        margin: auto;
      }
      
      /* Caption text */
      .text {
        color: #f2f2f2;
        font-size: 15px;
        padding: 8px 12px;
        position: absolute;
        bottom: 8px;
        width: 100%;
        text-align: center;
      }
      
      /* Number text (1/3 etc) */
      .numbertext {
        color: #f2f2f2;
        font-size: 12px;
        padding: 8px 12px;
        position: absolute;
        top: 0;
        color:black;
      }
      
      /* The dots/bullets/indicators */
      .dot {
        height: 15px;
        width: 15px;
        margin: 0 2px;
        background-color: #bbb;
        border-radius: 50%;
        display: inline-block;
        transition: background-color 0.6s ease;
      }
      
      .active {
        background-color: #717171;
      }
      
      /* Fading animation */
      .fade {
        -webkit-animation-name: fade;
        -webkit-animation-duration: 1.5s;
        animation-name: fade;
        animation-duration: 1.5s;
      }
      
      @-webkit-keyframes fade {
        from {opacity: .4} 
        to {opacity: 1}
      }
      
      @keyframes fade {
        from {opacity: .4} 
        to {opacity: 1}
      }
      
      /* On smaller screens, decrease text size */
      @media only screen and (max-width: 300px) {
        .text {font-size: 11px}
      }
      .customer{
      height: 700px;
      padding: 10px;
      border: 1px solid rgba(54, 64, 74, 0.05);
      -webkit-border-radius: 5px;
      border-radius: 5px;
      -moz-border-radius: 5px;
      background-clip: padding-box;
      margin-bottom: 20px;
      background-color: #ffffff;
    }
    .customeritem{
      height: 570px;
      padding: 10px;
      border: 1px solid rgba(54, 64, 74, 0.05);
      -webkit-border-radius: 5px;
      border-radius: 5px;
      -moz-border-radius: 5px;
      background-clip: padding-box;
      margin-bottom: 20px;
      background-color: #ffffff;
      overflow: auto;
    }
    .table td{
        padding: 0.25rem;
        vertical-align: top;
        border-top: 1px solid #e3e6f0;
    }
    .product_name {
        height: 30px;
        overflow: hidden;
        border-bottom: 1px solid #f1f1f1;
    }
    #poTable {
        background-color: white;
        overflow-x: hidden;
        display: block;
        height: 450px;
    }
    .get_name{
        white-space: nowrap; 
        text-overflow: ellipsis;
        max-width: 100px;
        overflow: hidden;
        max-height: 30px;
    }
      </style>
@push('js')

<script type="text/javascript">
    setInterval(function reloadtable(){
           $('#poTable tbody').empty();
            var storage = JSON.parse(localStorage.getItem('product'));
            var totalitem = 0;
            let total = 0;
            let grand_total = 0;
            let discount_total = 0;
            let final_total = 0;
            var totalitem = 0;
            $.each(storage,function(index,row){
            var tax = '0' ;
            var subtotal = parseFloat(row.price * row.quantity).toFixed(2) ;
             // -----------------discount-----------------------
            totalitem++;
            $("#total_item").text(totalitem);
            total += row.price * row.quantity    
            // --------------------discount the end--------------------
            $('#poTable tbody').append("<tr>"
                +'<td class="get_name">'+row.name+'</td>'
                +'<td style="text-align: center">'+ parseFloat(row.price).toFixed(2) +'</td>'
                +'<td style="text-align: center">'+row.quantity+'</td>'
                +'<td style="text-align: center">'+'$ '+subtotal+'</td>'
                +"</tr>")
            })
            grand_total += total;
            $('#tddiscount').text(localStorage.getItem('discount'));
            $("#grand_total").text(localStorage.getItem('total')+'$');
    });

</script>
@endpush
    @csrf
<div class="col-md-12 row">
  <div class="col-md-5" style="margin-left: -20px;">
  {{-- <div class="col-md-5"> --}}
        <div class="card">
            <div class="card-body" style="background: white;">
                <div class="row">
                    <div class="col-md-12" >
                        <div class="control-group table-group">
                            <div class="controls table-controls">
                                <table id="poTable" class="table table-bordered table-striped">
                                    <thead>
                                    <tr class="text-center bg-gradient-info" style="color: white" >
                                        <th style="width: 50%">Product</th>
                                        <th style="width: 10%">Price</th>
                                        <th style="width: 10%" >Qty</th>
                                        <th style="width: 30%">Total</th>
                                    </tr>
                                    </thead>
                                    <tbody id="tbody">
                                    </tbody>
                                </table>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer" style="position: fixed;bottom: 37px;width: 37.7%;margin-left: -1px;border: 1px solid #e3e6f0;background: white;">
                <table  class="table items table-striped table-bordered">
                    <tbody>
                        <tr>
                            <td  colspan="2" style="padding: 5px 10px"><b>Discount</b></td>
                                <td colspan="3" class="text-center" style="padding: 5px 10px;font-weight:bold;">
                                    <span id="tddiscount" value="">0.00</span>
                                </td>
                            </tr>
                        <tr>
                            <td style="padding: 5px 10px;border-top: 1px solid #DDD;"><b>Items</b></td>
                            <td class="text-center" style="padding: 5px 10px;font-size: 14px; font-weight:bold;border-top: 1px solid #DDD;">
                                <span id="total_item">0</span>
                            </td>
                            <td style="padding: 5px 10px;border-top: 1px solid #DDD;"><b>Total</b></td>
                            <td class="text-center" colspan="2" style="padding: 5px 10px;font-size: 14px; font-weight:bold;border-top: 1px solid #DDD;">
                                <span id="grand_total" value="">0.00</span>
                            </td>
                        </tr>
                    
                    </tbody>
                </table>
            </div>
        </div>
    </div>
        <div class="col-md-6">
            <div class="card" id="productget" style="width: 800px;background: white;height: 100%;">
                <div class="card-body">
                        <div class="mySlides fade">
                          <img src="/images/backend/1.jpg" style="width:100%;">
                        </div>
                        <div class="mySlides fade">
                           <img src="/images/backend/the-mart.jpg" style="width:100%;">
                        </div>
                        <div class="mySlides fade">
                          <img src="/images/backend/role.jpg" style="width:100%;">
                        </div>
                        <div style="text-align:center">
                            <span class="dot"></span> 
                            <span class="dot"></span> 
                            <span class="dot"></span>
                            </div>
                          <script>
                            var slideIndex = 0;
                            showSlides();
                            
                            function showSlides() {
                              var i;
                              var slides = document.getElementsByClassName("mySlides");
                              var dots = document.getElementsByClassName("dot");
                              for (i = 0; i < slides.length; i++) {
                                slides[i].style.display = "none";  
                              }
                              slideIndex++;
                              if (slideIndex > slides.length) {slideIndex = 1}    
                              for (i = 0; i < dots.length; i++) {
                                dots[i].className = dots[i].className.replace(" active", "");
                              }
                              slides[slideIndex-1].style.display = "block";  
                              dots[slideIndex-1].className += " active";
                              setTimeout(showSlides, 1000); 
                            }
                          </script>
                </div>
                <div class="card-footer">
                        <img src="/assets/images/qr.png" alt=""  id="aba" width="24.6%">
                        <img src="/assets/images/aba.jpg" alt="" id="acleda" width="24.6%">
                        <img src="/assets/images/acledaqr.png" alt="" id="wing" width="24.6%">
                        <img src="/assets/images/acleda.png" alt="" id="foodpanda" width="24.5%">
                </div>
            </div>
        </div>
</div>
@endsection

