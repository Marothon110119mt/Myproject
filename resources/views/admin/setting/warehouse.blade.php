@section('Setting-active', 'active')
@section('list_Warehouse', 'active')
@section('Setting', 'show')
@extends('layouts.backend.app',[
    'title' => 'List Warehouse',
    'pageTitle' => 'List Warehouse',
])
@push('css')
<link href="{{ asset('template/backend/sb-admin-2') }}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
            {{-- <a href="/unit/create" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Add unit</a> --}}
            <button id="add_unit" type="submit" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#meme">
                Add Warehouse
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
                        <th>Image</th>
                        <th>Name</th>
                        <th>Code</th>
                        <th>Action</th>
                        <th hidden>photo</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($warehouse as $row)
                        <tr>
                        <th hidden>{{$row->id}}</th>
                        <th scope="row"  width="1%">{{$loop->iteration}}</th>
                        <td  width="80px">
                            @if ($row->photo == 'NULL')
                            <img src="/upload/no_image.jpg" alt="" width="80px" height="80px">
                            @else 
                            <img src="/upload/category/{{ $row->photo  }}" alt="" width="80px" height="80px">
                            @endif
                        </td>
                        <td>{{$row->name}}</td>
                        <td>{{$row->code}}</td>
                        <td width="80px" style="text-align: center">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a id="edit_unit" class="btn btn-primary btn-sm mr-1 edit_unit"><i class="fas fa-edit"></i></a>
                                <a href="/warehouse/{{$row->id}}/question" class="btn btn-danger btn-sm mr-1"><i class="fas fa-trash"></i></a>
                            </div>
                        </td>
                        <td hidden>{{$row->photo}}</td>

                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th hidden>id</th>
                        <th>No</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Code</th>
                        <th>Action</th>
                        <th hidden>id</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

{{-- Form add Warehouse --}}
    <div class="modal fade" id="modal_add_unit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Information</h5>
            <button type="button" class="btn-close close_unit" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/warehouse/store" method="POST" enctype="multipart/form-data">
                        @csrf
                    <div class="form-group">
                        <label for="name">Warehouse Name</label>
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
                        function add_myFunction() {
                        document.getElementById("code").onclick = function(){
                        document.getElementById("code").value =  generateCardNo(8);
                        };
                        }
                        </script>
                    <div class="form-group ">
                        <label for="code" >Warehouse Code</label>
                        <i class="fa fa-random"></i>
                        <input type="text" class="form-control" id="code" onclick="add_myFunction()" name="code" value="">
                        @error('code')
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
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary close_unit" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary ">Add Warehouse</button>
                </div>
            </form>
        </div>
        </div>
    </div>
{{-- end --}}

{{-- Form edit unit --}}

<div class="modal fade" id="modal_edit_unit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Information</h5>
          <button type="button" class="btn-close close_unit" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="/warehouse/update" method="POST" enctype="multipart/form-data">
                        @csrf
                <div class="form-group">
                    <input hidden type="text" class="form-control" id="edit_id" name="id" value="">
                


                        <label for="name">Warehouse Name</label>
                        <input type="text" class="form-control" id="edit_name" name="name" value="">
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
                        function edit_myFunction() {
                        document.getElementById("edit_code").onclick = function(){
                        document.getElementById("edit_code").value =  generateCardNo(8);
                        };
                        }
                        </script>
                    <div class="form-group ">
                        <label for="code" >Warehouse Code</label>
                        <i class="fa fa-random"></i>
                        <input type="text" class="form-control" id="edit_code" onclick="edit_myFunction()" name="code" value="">
                        @error('code')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <img id="view_img" src="/upload/unit/" width="100%" height="150px" class="mt-2" alt="">
                    </div>
                    <div class="form-group">
                        <label for="photo">Image</label>
                        <input type="file" value="" class="form-control" id="photo" name="photo">
                        @error('photo')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary close_unit" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary ">Edit Warehouse</button>
              </div>
            </form>
      </div>
    </div>
</div>
@stop

@push('js')
<script type="text/javascript">
    $("#add_unit").click(function(){
        $('#modal_add_unit').modal('show')
    });
    $(".close_unit").click(function(){
        $('#modal_add_unit').modal('hide')
        $('#modal_edit_unit').modal('hide')
    });
    $(document).ready(function(){
    var table = $('#dataTable').DataTable();
    table.on('click','.edit_unit',function(){
        $tr = $(this).closest('tr');
        if($($tr).hasClass('child')){
            $tr = $tr.prev('.parent') ;
        }
        var data = table.row($tr).data();
        console.log(data);
        $('#edit_id').val(data[0]);
        $('#edit_name').val(data[3]);
        $('#edit_code').val(data[4]);
        $('#edit_photo').val(data[6]);
        if(data[6] == "NULL"){
            $("#view_img").attr('src','/upload/no_image.jpg');
        }
        else{
            $("#view_img").attr('src','/upload/category/'+data[6]);
        }
        $('#modal_edit_unit').modal('show');
    })
    });
</script>
<script src="{{ asset('template/backend/sb-admin-2') }}/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="{{ asset('template/backend/sb-admin-2') }}/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="{{ asset('template/backend/sb-admin-2') }}/js/demo/datatables-demo.js"></script>
@endpush

