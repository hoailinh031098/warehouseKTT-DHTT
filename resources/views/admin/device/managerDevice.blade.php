@extends('layouts.admin')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Thiết bị</h6>
    </div>
    <div class="py-2 container">
        <a id="modal-create_device" name="modal-create_device" type="button" onclick="createDevice()" class="btn btn-primary btn-icon-split">
            <span class="icon text-white-50">
                <i class="fas fa-plus"></i>
            </span>
            <span class="text">Thêm Thiết Bị</span>
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Name Group</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Name Group</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
    <!--Device Modal-->
    <div class="modal fade show" id="modalDevice" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel"></h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col-sm-12 mb-3 mb-sm-0">
                            <label>Tên Thiết Bị</label>
                            <input type="text" class="form-control form-control-user" id="device_name"
                                name="device_name" required>
                        </div>
                        <div class="col-sm-12 mb-3 mb-sm-0">
                            <label>Nhóm Thiết bị</label>
                            <select class="custom-select form-control" id="dg_id" name="dg_id" required>
                                <option></option>
                                @foreach ($dg as $dg)
                                <option value="{{ $dg->dg_id}}">{{ $dg->dg_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-primary" type="button" onclick="saveDevice()" id="btn-save_device">Save</a>
                    <a class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$(document).ready(function(){
    var table = $('#dataTable').DataTable({
        bDestroy: true,
        processing: true,
        serverSide: true,
        ajax: "{{ route('getManagerDevice') }}",
        columns: [
            {data: 'device_id', name: 'device_id'},
            {data: 'device_name', name: 'device_name'},
            {data: 'dg_name', name: 'dg_name'},
            {data: 'action'},
        ]
    });
});
    function reloadTable()
    {
        $('#dataTable').DataTable().ajax.reload();
    }

    function createDevice(){
        $("#ModalLabel").text("Tạo Thiết Bị");
        $('#device_name').val('');
        $('#dg_id').val('');
        $('#btn-save_device').attr('data-action', "create_device");
        $('#modalDevice').modal('show');
    } 

    function editDevice(device_id){
        $.ajax({
                    type:'GET',
                    url:"{{ route('findDevice') }}",
                    data:{
                        "device_id":device_id
                    },
                    success:function(data){
                        console.log(data.success);
                        $("#device_name").val(data.success.device_name);
                        $("#dg_id").val(data.success.dg_id);
                    },
                });
        $("#ModalLabel").text("Sửa Thiết Bị");
        $('#btn-save_device').attr('data-action',"edit_device");
        $('#btn-save_device').attr('data-device_id', device_id);
        $('#modalDevice').modal('show');    
    }

    function saveDevice(){
        const action = $("#btn-save_device").attr('data-action');
        console.log(action);
        if(action == "create_device")
        {
            const device_name = $("#device_name").val();
            const dg_id = $("#dg_id").val();
            $.ajax({
                type:'POST',
                url:"{{ route('createDevice') }}",
                data:{
                    "device_name":device_name,
                    "dg_id":dg_id
                },
                success:function(data){
                    alert(data.success);
                    $("#device_name").val("");
                    $("#dg_id").val("");
                    reloadTable();
                },
            });
            
        }
        if(action == "edit_device")
        {
            const device_id = $("#btn-save_device").attr('data-device_id');
            const device_name = $("#device_name").val();
            const dg_id = $("#dg_id").val();
            $.ajax({
                type:'PUT',
                url:"{{ route('editDevice') }}",
                data:{
                    "device_id":device_id,
                    "device_name":device_name,
                    "dg_id":dg_id
                },
                success:function(data){
                    alert(data.success);
                    $('#modalDevice').modal('toggle');
                    reloadTable();
                },
            });
            
        }
        if(action != "create_device" && action != "edit_device")
        {
            console.log("ko xac dinh");
        }
    }

    function deleteDevice(device_id)
    {
        var result = confirm("Xác nhận xoá thiết bị ?");
        if(result)  
        {
            $.ajax({
                type:'DELETE',
                url:"{{ route('deleteDevice') }}",
                data:{
                    "device_id":device_id
                },
                success:function(data){
                    reloadTable();
                },
            });
        } else {
        }
    }

@endsection