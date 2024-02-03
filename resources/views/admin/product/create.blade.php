@extends('layouts.backend.app',[
    'title' => ' Add Prodcut ',
    'pageTitle' => ' Add Prodcut',
])
@section('product-active', 'active')
@section('add_product', 'active')
@section('product', 'show')
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
            Information
        </h6>
    </div>
    <div class="card-body">
    <!-- Page Heading -->
    <form action="/product/store" method="POST" enctype="multipart/form-data">
        @csrf
    <div class="row col-md-12">
        <div class="col-md-1">
        </div>
      <div class="col-md-5">
        <div class="form-group">
            <label for="name">Product Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}">
            @error('name')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <script>
            function generateCardNo(x) {
                if (!x) {
                    x = 16;
                }
                chars = '1234567890';
                no = '';
                for (var i = 0; i < x; i++) {
                    var rnum = Math.floor(Math.random() * chars.length);
                    no += chars.substring(rnum, rnum + 1);
                }
                return no;
            }
            function myFunction() {
              document.getElementById("code").onclick = function(){
              document.getElementById("code").value =  generateCardNo(8);
              };
            }
            </script>
        <div class="form-group ">
            <label for="code" >Product Code</label>
            <i class="fa fa-random"></i>
            <input type="text" class="form-control" id="code" onclick="myFunction()" name="code" value="{{old('code')}}">
            @error('code')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="cost">Cost</label>
            <input type="text" class="form-control" id="cost" name="cost" value="{{old('cost')}}">
            @error('cost')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="price"> Price</label>
            <input type="text" class="form-control" id="price" name="price" value="{{old('price')}}">
            @error('price')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="unit">Unit</label>
            <select class="form-control " id="unit" name="unit">
                <option selected disabled>Select Unit</option>
                @foreach ($unit as $row)
                    <option value="{{$row->id}}">{{$row->name}}</option>
                @endforeach
            </select>
            @error('unit')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="brand">Brand</label>
            <select class="form-control" id="brand" name="brand">
                <option selected disabled>Select Brand</option>
                @foreach ($brand as $row)
                    <option value="{{$row->id}}">{{$row->name}}</option>
                @endforeach
            </select>
            @error('brand')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary btn-sm">Add Product</button>
        <a href="/product" class="btn btn-secondary btn-sm">Cancel</a>
    </div>
    <div class="col-md-1">
    </div>

    <div class="col-md-5">
        <div class="form-group">
            <label for="type">Type</label>
            <select class="form-control" id="type" name="type">
                <option selected disabled>Select type</option>
                    <option value="Row">Row</option>
                    <option value="Middle">Middle</option>
                    <option value="Final">Final</option>
            </select>
            @error('type')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="category">Category</label>
            <select class="form-control" id="category" name="category">
                <option selected disabled>Select Category</option>
                @foreach ($category as $row)
                    <option value="{{$row->id}}">{{$row->name}}</option>
                @endforeach
            </select>
            @error('category')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="alert"> Alert Quantity</label>
            <input type="text" class="form-control" id="alert" name="alert" value="{{old('alert')}}">
            @error('alert')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="photo">Image</label>
            <input type="file" class="form-control" id="photo" name="photo">
            @error('photo')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="editor">Detail</label>
            <textarea class="form-control" id="editor" rows="5"style="
            height: 125px;" name="detail">{{old('detail')}}</textarea>
            @error('detail')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
    
        </div>
    
    </div>
    </div>
   
</div>

</form>
@endsection
