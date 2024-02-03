@section('Setting-active', 'active')
@section('list_Bot', 'active')
@section('Setting', 'show')
@extends('layouts.backend.app',[
    'title' => 'List Bot',
    'pageTitle' => 'List Bot',
])
@push('css')
<link href="{{ asset('template/backend/sb-admin-2') }}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
            <button id="add_bot" type="submit" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#meme">
                Add Bot
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
                        <th>Bot Id</th>
                        <th>Token</th>
                        <th>Chat Id</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bot as $row)
                        <tr>
                        <th hidden>{{$row->id}}</th>
                        <th scope="row"  width="1%">{{$loop->iteration}}</th>
                        <td>{{$row->bot_id}}</td>
                        <td>{{$row->token}}</td>
                        <td>{{$row->chat_id}}</td>
                        <td width="80px" style="text-align: center">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a id="edit_bot" class="btn btn-primary btn-sm mr-1 edit_bot"><i class="fas fa-edit"></i></a>
                                <a href="/bot/{{$row->id}}/question" class="btn btn-danger btn-sm mr-1"><i class="fas fa-trash"></i></a>
                            </div>
                        </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Form add bot --}}
    <div class="modal fade" id="modal_add_bot" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Information</h5>
            <button type="button" class="btn-close close_bot" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/bot/store" method="POST" enctype="multipart/form-data">
                        @csrf
                    <div class="form-group">
                        <label for="bot_id">Bot Id</label>
                        <input type="text" class="form-control" id="bot_id" name="bot_id" value="{{old('bot_id')}}">
                        @error('bot_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="token">Token</label>
                        <input type="text" class="form-control" id="token" name="token" value="{{old('token')}}">
                        @error('token')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="chat_id">Chat Id</label>
                        <input type="text" class="form-control" id="chat_id" name="chat_id" value="{{old('chat_id')}}">
                        @error('chat_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary close_bot" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary ">Add Bot</button>
                </div>
            </form>
        </div>
        </div>
    </div>
{{-- end --}}

{{-- Form edit bot --}}

<div class="modal fade" id="modal_edit_bot" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Information</h5>
          <button type="button" class="btn-close close_bot" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="/bot/update" method="POST" enctype="multipart/form-data">
                        @csrf
                <div class="form-group">
                    <input hidden type="text" class="form-control" id="edit_id" name="id" value="">
                        <label for="bot_id">Bot Id</label>
                        <input type="text" class="form-control" id="edit_bot_id" name="bot_id" value="">
                        @error('bot_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                </div>
                <div class="form-group">
                    <label for="token">Token</label>
                    <input type="text" class="form-control" id="edit_token" name="token" value="">
                    @error('token')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="chat_id">Chat Id</label>
                    <input type="text" class="form-control" id="edit_chat_id" name="chat_id" value="">
                    @error('chat_id')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary close_bot" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary ">Edit Bot</button>
              </div>
            </form>
      </div>
    </div>
</div>
@stop

@push('js')
<script type="text/javascript">
    $("#add_bot").click(function(){
        $('#modal_add_bot').modal('show')
    });
    $(".close_bot").click(function(){
        $('#modal_add_bot').modal('hide')
        $('#modal_edit_bot').modal('hide')
    });
    $(document).ready(function(){
    var table = $('#dataTable').DataTable();
    table.on('click','.edit_bot',function(){
        $tr = $(this).closest('tr');
        if($($tr).hasClass('child')){
            $tr = $tr.prev('.parent') ;
        }
        var data = table.row($tr).data();
        console.log(data);
        $('#edit_id').val(data[0]);
        $('#edit_bot_id').val(data[2]);
        $('#edit_token').val(data[3]);
        $('#edit_chat_id').val(data[4]);
        $('#modal_edit_bot').modal('show');
    })
    });
</script>
<script src="{{ asset('template/backend/sb-admin-2') }}/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="{{ asset('template/backend/sb-admin-2') }}/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="{{ asset('template/backend/sb-admin-2') }}/js/demo/datatables-demo.js"></script>
@endpush

