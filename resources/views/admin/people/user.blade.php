@section('people-active', 'active')
@section('list_user', 'active')
@section('people', 'show')
@extends('layouts.backend.app',[
    'title' => 'List User',
    'pageTitle' => 'List User',
])
@push('css')
<link href="{{ asset('template/backend/sb-admin-2') }}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush
@section('content')
<style>
.modal-dialog {
    max-width: 800px;
    margin: 1.75rem auto;
}
</style>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
            <button id="add_customer" type="submit" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#meme">
                Add User
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
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($user as $row)
                        <tr>
                        <th hidden>{{$row->id}}</th>
                        <th scope="row"  width="1%">{{$loop->iteration}}</th>
                        <td>{{$row->name}}</td>
                        <td>{{$row->email}}</td>
                        <td>{{$row->phone}}</td>
                        <td>{{$row->status}}</td>
                        <td width="80px" style="text-align: center">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a id="edit_user" class="btn btn-primary btn-sm mr-1 edit_user"><i class="fas fa-edit"></i></a>
                                <a href="/customer/{{$row->id}}/question" class="btn btn-danger btn-sm mr-1"><i class="fas fa-trash"></i></a>
                            </div>
                        </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Form add User --}}
    <div class="modal fade" id="modal_add_customer" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Information</h5>
            <button type="button" class="btn-close close_user" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/user/create" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input id="name" type="text" style="text-align: center;" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                       
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="phone" class="form-control" id="phone" name="phone" aria-describedby="phoneHelp"  style="text-align: center;">
                            </div>
                            <div class="form-group">
                                <input id="password" placeholder="Password" style="text-align: center;" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input id="email" type="email"  style="text-align: center;"  class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="group_id">Group Permission</label>
                                {{-- <input id="group_id" type="text"   style="text-align: center;"  class="form-control @error('group_id') is-invalid @enderror" name="group_id" value="{{ old('group_id') }}" required autocomplete="group_id"> --}}
                                <select class="form-control" id="group_id" name="group_id">
                                    <option selected disabled>Select Role</option>
                                    @foreach ($role as $row)
                                        <option value="{{$row->id}}">{{$row->name}}</option>
                                    @endforeach
                                </select>
                                @error('group_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input id="password-confirm"  placeholder="Password Comfirm" style="text-align: center;" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary close_user" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">
                    {{ __('Register') }}
                </button>
            </form>

            </div>
            
        </div>
        </div>
    </div>
{{-- end --}}

{{-- Form edit User --}}

<div class="modal fade" id="modal_edit_user" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Information</h5>
          <button type="button" class="btn-close close_user" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="/user/update" method="POST" enctype="multipart/form-data">
                        @csrf
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <input hidden type="text" class="form-control" id="edit_id" name="id" value="">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="edit_name" name="name" value="">
                            @error('name')
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
                        <input id="edit_password" placeholder="Password" style="text-align: center;" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" id="edit_email" name="email" value="">
                        @error('email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="group_id">Group Permission</label>
                        {{-- <input id="edit_group_id" type="text"   style="text-align: center;"  class="form-control @error('group_id') is-invalid @enderror" name="group_id" value="{{ old('group_id') }}" autocomplete="group_id"> --}}
                        <select class="form-control" id="edit_group_id" name="group_id">
                            <option selected disabled>Select Role</option>
                            @foreach ($role as $row)
                                <option value="{{$row->id}}">{{$row->name}}</option>
                            @endforeach
                        </select>
                        @error('group_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input id="edit_password-confirm"  placeholder="Password Comfirm" style="text-align: center;" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close_user" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary ">Edit Customer</button>
            </div>
            </form>
          
      </div>
    </div>
</div>
@stop

@push('js')
<script type="text/javascript">
    $("#add_customer").click(function(){
        $('#modal_add_customer').modal('show')
    });
    $(".close_user").click(function(){
        $('#modal_add_customer').modal('hide')
        $('#modal_edit_user').modal('hide')
    });
    $(document).ready(function(){
        var table = $('#dataTable').DataTable();
        table.on('click','.edit_user',function(){
            $tr = $(this).closest('tr');
            if($($tr).hasClass('child')){
                $tr = $tr.prev('.parent') ;
            }
            var data = table.row($tr).data();
            $('#edit_id').val(data[0]);
            $('#edit_name').val(data[2]);
            $('#edit_email').val(data[3]);
            $('#edit_phone').val(data[4]);
            $('#edit_group_id').val(data[5]);
            $('#modal_edit_user').modal('show');
        })
    });
</script>
<script src="{{ asset('template/backend/sb-admin-2') }}/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="{{ asset('template/backend/sb-admin-2') }}/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="{{ asset('template/backend/sb-admin-2') }}/js/demo/datatables-demo.js"></script>
@endpush

