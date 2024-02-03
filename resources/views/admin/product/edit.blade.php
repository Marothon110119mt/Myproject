@extends('layouts.backend.app',[
    'title' => ' Edit Prodcut ',
    'pageTitle' => ' Edit Prodcut',
])
@section('product-active', 'active')
@section('edit_product', 'active')
@section('product', 'show')

@section('content')

    <!-- Page Heading -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                Information
            </h6>
        </div>
        <div class="card-body">
        <form action="/product/{{$product->id}}/update" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="row col-md-12">
                <div class="col-md-1">
                </div>
            <div class="col-md-5">
                <div class="form-group">
                    <label for="name">Product Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{old('name') ? old('name') : $product->name}}">
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
                <div class="form-group">
                    <label for="code"> Product Code</label>
                        <input type="text" class="form-control" id="code" onclick="myFunction()" name="code" value="{{old('code') ? old('code') : $product->code}}">
                    @error('code')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="cost">Cost</label>
                        <input type="text" class="form-control" id="cost" name="cost" value="{{old('cost') ? old('cost') : $product->cost}}">
                    @error('code')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            
                <div class="form-group">
                    <label for="price">Price</label>
                        <input type="text" class="form-control" id="price" name="price" value="{{old('price') ? old('price') : $product->price}}">
                    @error('code')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="unit">Unit</label>
                    <select class="form-control" id="unit" name="unit">
                            @if ($product->unit == NULL)
                            <option selected disabled>Select Unit</option>
                            @endif
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
                        @if ($product->brand ==NULL)
                        <option selected disabled>Select Brand</option>
                            @endif
                        @foreach ($brand as $row)
                                <option value="{{$row->id}}">{{$row->name}}</option>
                        @endforeach

                    </select>
                    @error('brand')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary btn-sm">Edit Product</button>
                <a href="/product" class="btn btn-secondary btn-sm">Back</a>
            </div>
            <div class="col-md-1">
            </div>
            <div class="col-md-5">
                
                <div class="form-group">
                    <label for="type">Type</label>
                        {{-- <input type="text" class="form-control" id="type" name="type" value="{{old('type') ? old('type') : $product->type}}"> --}}
                        <select class="form-control" id="type" name="type">
                            @if ($product->type == 'Row')
                            <option value="Row">Row</option>
                            <option value="Middle">Middle</option>
                            <option value="Final">Final</option>                   
                            @endif
                            @if ($product->type == 'Middle')
                            <option value="Middle">Middle</option>
                            <option value="Row">Row</option>
                            <option value="Final">Final</option> 
                            @endif
                            @if ($product->type == 'Final' )
                            <option value="Final">Final</option> 
                            <option value="Row">Row</option>
                            <option value="Middle">Middle</option>
                            @endif

                        </select>
                    @error('code')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="category">Category</label>
                    <select class="form-control" id="category" name="category">
                        @if ($product->category== NULL)
                        <option selected disabled>Select Category</option>
                        @endif
                        @foreach ($category as $row)
                                <option value="{{$row->id}}">{{$row->name}}</option>
                        @endforeach
                    </select>
                    @error('category')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="alert">Alert Quantity</label>
                        <input type="text" class="form-control" id="alert" name="alert" value="{{old('alert') ? old('alert') : $product->alert}}">
                    @error('code')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>  
                <div class="row">
                    <div class="col-md-5">
                        <img src="/upload/product/{{$product->photo}}" width="100%" height="150px" class="mt-2" alt="">
                    </div>
                    <div class="col-md-7">
                        <div class="form-group">
                            <label for="photo">Photo</label>
                            <input type="file" class="form-control" id="photo" name="photo">
                            @error('photo')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="editor">detail</label>
                    <textarea class="form-control" id="editor" rows="5"style="
                    height: 125px;" name="detail">{{old('detail')}}</textarea>
                    @error('detail')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div>
            </div>
        </form>
</div>
</div>

@endsection