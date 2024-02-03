@section('people-active', 'active')
@section('list_supplier', 'active')
@section('people', 'show')
@extends('layouts.backend.app',[
    'title' => 'List Supplier',
    'pageTitle' => 'List Supplier',
])
@push('css')
<link href="{{ asset('template/backend/sb-admin-2') }}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush
@section('content')
<style>
#modal-dialog {
    max-width: 800px;
    margin: 1.75rem auto;
}
</style>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
            <button id="add_supplier" type="submit" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#meme">
                Add Supplier
              </button>
        </h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th hidden>id</th>
                        <th>No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>phone</th>
                        <th>Address</th>
                        <th>City</th>
                        <th>State</th>
                        <th>Postal Code</th>
                        <th>Country</th>
                        <th>Action</th>
                        <th hidden>cf1</th>
                        <th hidden>cf2</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($supplier as $row)
                        <tr>
                        <th hidden>{{$row->id}}</th>
                        <th scope="row"  width="1%">{{$loop->iteration}}</th>
                        <td>{{$row->name}}</td>
                        <td>{{$row->email}}</td>
                        <td>{{$row->phone}}</td>
                        <td>{{$row->address}}</td>
                        <td>{{$row->city}}</td>
                        <td>{{$row->state}}</td>
                        <td>{{$row->postal_code}}</td>
                        <td>{{$row->country}}</td>
                        <td width="80px" style="text-align: center">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a id="edit_supplier" class="btn btn-primary btn-sm mr-1 edit_supplier"><i class="fas fa-edit"></i></a>
                                <a href="/supplier/{{$row->id}}/question" class="btn btn-danger btn-sm mr-1"><i class="fas fa-trash"></i></a>
                            </div>
                        </td>
                        <td hidden>{{$row->cf1}}</td>
                        <td hidden>{{$row->cf2}}</td>

                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th hidden>id</th>
                        <th>No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>phone</th>
                        <th>Address</th>
                        <th>City</th>
                        <th>State</th>
                        <th>Postal Code</th>
                        <th>Country</th>
                        <th>Action</th>
                        <th hidden>cf1</th>
                        <th hidden>cf2</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

{{-- Form add supplier --}}
    <div class="modal fade" id="modal_add_supplier" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog" id="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Information</h5>
            <button type="button" class="btn-close close_supplier" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/supplier/store" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="name">Supplier Name</label>
                                <input type="text" class="form-control" focus id="name" name="name" value="{{old('name')}}">
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" id="email" name="email" value="{{old('email')}}">
                                @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="text" class="form-control" id="phone" name="phone" value="{{old('phone')}}">
                                @error('phone')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input type="text" class="form-control" id="address" name="address" value="{{old('address')}}">
                                @error('address')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="city">City</label>
                                <input type="text" class="form-control" id="city" name="city" value="{{old('city')}}">
                                @error('city')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                         
                       
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                            
                                <label for="state">State</label>
                                <input type="text" class="form-control" id="state" name="state" value="{{old('state')}}">
                                @error('state')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="postal_code">Postal Code</label>
                                <input type="text" class="form-control" id="postal_code" name="postal_code" value="{{old('postal_code')}}">
                                @error('postal_code')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="country">Country</label>
                                <input type="text" class="form-control" id="country" name="country" value="{{old('country')}}">
                                @error('country')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="cf1">Supplier Custom Field 1</label>
                                <input type="text" class="form-control" id="cf1" name="cf1" value="{{old('cf1')}}">
                                @error('cf1')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="cf2">Supplier Custom Field 2</label>
                                <input type="text" class="form-control" id="cf2" name="cf2" value="{{old('cf2')}}">
                                @error('cf2')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary close_supplier" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary ">Add Supplier</button>
                </div>
            </form>
        </div>
        </div>
    </div>
{{-- end --}}

{{-- Form edit supplier --}}

<div class="modal fade" id="modal_edit_supplier" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" id="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Information</h5>
          <button type="button" class="btn-close close_supplier" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="/supplier/update" method="POST" enctype="multipart/form-data">
                        @csrf
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <input hidden type="text" class="form-control" id="edit_id" name="id" value="">
                            <label for="name">Supplier Name</label>
                            <input type="text" class="form-control" id="edit_name" name="name" value="">
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" id="edit_email" name="email" value="">
                        @error('email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="text" class="form-control" id="edit_phone" name="phone" value="">
                        @error('phone')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" class="form-control" id="edit_address" name="address" value="">
                        @error('address')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="city">City</label>
                        <input type="text" class="form-control" id="edit_city" name="city" value="">
                        @error('city')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                    
                        <label for="state">State</label>
                        <input type="text" class="form-control" id="edit_state" name="state" value="">
                        @error('state')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="postal_code">Postal Code</label>
                        <input type="text" class="form-control" id="edit_postal_code" name="postal_code" value="">
                        @error('postal_code')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="country">Country</label>
                        <input type="text" class="form-control" id="edit_country" name="country" value="">
                        @error('country')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="cf1">Supplier Custom Field 1</label>
                        <input type="text" class="form-control" id="edit_cf1" name="cf1" value="">
                        @error('cf1')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="cf2">Supplier Custom Field 2</label>
                        <input type="text" class="form-control" id="edit_cf2" name="cf2" value="">
                        @error('cf2')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close_supplier" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary ">Edit Supplier</button>
            </div>
            </form>
          
      </div>
    </div>
</div>
@stop

@push('js')
<script type="text/javascript">
    $("#add_supplier").click(function(){
        $('#modal_add_supplier').modal('show')
    });
    $(".close_supplier").click(function(){
        $('#modal_add_supplier').modal('hide')
        $('#modal_edit_supplier').modal('hide')
    });
    $(document).ready(function(){
    var table = $('#dataTable').DataTable();
    table.on('click','.edit_supplier',function(){
        $tr = $(this).closest('tr');
        if($($tr).hasClass('child')){
            $tr = $tr.prev('.parent') ;
        }
        var data = table.row($tr).data();
        $('#edit_id').val(data[0]);
        $('#edit_name').val(data[2]);
        $('#edit_email').val(data[3]);
        $('#edit_phone').val(data[4]);
        $('#edit_address').val(data[5]);
        $('#edit_city').val(data[6]);
        $('#edit_state').val(data[7]);
        $('#edit_postal_code').val(data[8]);
        $('#edit_country').val(data[9]);
        $('#edit_cf1').val(data[11]);
        $('#edit_cf2').val(data[12]);
        $('#modal_edit_supplier').modal('show');
    })
    });
</script>
<script src="{{ asset('template/backend/sb-admin-2') }}/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="{{ asset('template/backend/sb-admin-2') }}/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="{{ asset('template/backend/sb-admin-2') }}/js/demo/datatables-demo.js"></script>
@endpush

