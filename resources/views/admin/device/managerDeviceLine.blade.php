@extends('layouts.admin')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Dòng thiết bị</h6>
    </div>
    <div class="py-2 container">
        <a id="modal-create_device" name="modal-create_deviceLine" type="button" onclick="createDeviceLine()" class="btn btn-primary btn-icon-split">
            <span class="icon text-white-50">
                <i class="fas fa-plus"></i>
            </span>
            <span class="text">Thêm Dòng Thiết Bị</span>
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Name Device</th>
                        <th>Name Device Group</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Name Device</th>
                        <th>Name Device Group</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
    <!--Device Modal-->
    <div class="modal fade show" id="modalDeviceLine" tabindex="-1" aria-hidden="true">
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
                            <label>Tên Dòng Thiết Bị</label>
                            <input type="text" class="form-control form-control-user" id="dl_name"
                                name="dl_name" required>
                        </div>

                        <div class="col-sm-12 mb-3 mb-sm-0">
                            <label>Nhóm Thiết bị</label>
                            <select class="custom-select form-control" id="dg_id" name="dg_id" required>
                                <option value="0"><--Select--></option>
                                @foreach ($dg as $dg)
                                    <option value="{{ $dg->dg_id}}">{{ $dg->dg_name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-sm-12 mb-3 mb-sm-0">
                            <label>Thiết bị</label>
                            <select class="custom-select form-control" id="device_id" name="device_id" required>
                                <option value="0"><-- Select --></option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-primary" type="button" onclick="saveDevice()" id="btn-save_deviceLine">Save</a>
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
        ajax: "{{ route('getManagerDeviceLine') }}",
        columns: [
            {data: 'dl_id', name: 'dl_id'},
            {data: 'dl_name', name: 'dl_name'},
            {data: 'device_name', name: 'device_name'},
            {data: 'dg_name', name: 'dg_name'},
            {data: 'action'},
        ]
    });

    $("#dg_id").change(function(){
        var dg_id = $(this).val();
        console.log(dg_id);
        $.ajax({
            type:'GET',
            url:"{{ route('findDeviceByDG') }}",
            data:{
                "dg_id":dg_id
            },
            success:function(data){
                console.log(data.success);
                var len = data.success.length;
                $("#device_id").empty();
                for( var i = 0; i<len; i++){
                    var id = data.success[i]['device_id'];
                    var name = data.success[i]['device_name'];
                    $("#device_id").append("<option value='"+id+"'>"+name+"</option>");
                }
            },
        });
    });
});
    function reloadTable()
    {
        $('#dataTable').DataTable().ajax.reload();
    }

    function createDeviceLine(){
        $("#ModalLabel").text("Tạo Dòng Thiết Bị");
        $('#dl_name').val('');
        $('#dg_id').val(0);
        $('#device_id').val(0);
        $('#btn-save_deviceLine').attr('data-action', "create_deviceLine");
        $('#modalDeviceLine').modal('show');
    } 

    function editDeviceLine(dl_id){
        $.ajax({
                    type:'GET',
                    url:"{{ route('findDeviceLine') }}",
                    data:{
                        "dl_id":dl_id,
                    },
                    success:function(data){
                        console.log(data.device.device_id);
                        $('#dl_name').val(data.deviceLine.dl_name);
                        $('#dg_id').val(data.device.dg_id);
                        $.ajax({
                            type:'GET',
                            url:"{{ route('findDeviceByDG') }}",
                            data:{
                                "dg_id":data.device.dg_id
                            },
                            success:function(data){
                                console.log(data.success);
                                var len = data.success.length;
                                for( var i = 0; i<len; i++){
                                    const id = data.success[i]['device_id'];
                                    const name = data.success[i]['device_name'];
                                    $("#device_id").append("<option value='"+id+"'>"+name+"</option>");
                                };
                                $('#device_id').val(29);
                            },
                        });
                    },
                });
        $("#ModalLabel").text("Sửa Dòng Thiết Bị");
        $('#btn-save_deviceLine').attr('data-action',"edit_deviceLine");
        $('#btn-save_deviceLine').attr('data-dl_id', dl_id);
        $('#modalDeviceLine').modal('show');    
    }

    function saveDevice(){
        const action = $("#btn-save_deviceLine").attr('data-action');
        console.log(action);
        if(action == "create_deviceLine")
        {
            const dl_name = $("#dl_name").val();
            const device_id = $("#device_id").val();
            console.log(dl_name,device_id,dg_id);
            $.ajax({
                type:'POST',
                url:"{{ route('createDeviceLine') }}",
                data:{
                    "dl_name":dl_name,
                    "device_id":device_id
                },
                success:function(data){
                    alert(data.success);
                    reloadTable();
                },
            });
            
        }
        if(action == "edit_deviceLine")
        {
            const dl_id = $("#btn-save_deviceLine").attr('data-dl_id');
            const dl_name = $("#dl_name").val();
            const device_id = $("#device_id").val();
            $.ajax({
                type:'PUT',
                url:"{{ route('editDeviceLine') }}",
                data:{
                    "dl_id":dl_id,
                    "dl_name":dl_name,
                    "device_id":device_id,

                },
                success:function(data){
                    alert(data.success);
                    $('#modalDeviceLine').modal('toggle');
                    reloadTable();
                },
            });
            
        }
        if(action != "create_deviceLine" && action != "edit_deviceLine")
        {
            console.log("ko xac dinh");
        }
    }

    function deleteDeviceLine(dl_id)
    {
        var result = confirm("Xác nhận xoá thiết bị ?");
        if(result)  
        {
            $.ajax({
                type:'DELETE',
                url:"{{ route('deleteDeviceLine') }}",
                data:{
                    "dl_id":dl_id
                },
                success:function(data){
                    reloadTable();
                },
            });
        } else {
        }
    }

@endsection