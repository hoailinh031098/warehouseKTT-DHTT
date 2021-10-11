@extends('layouts.admin')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Nhóm Thiết Bị</h6>
    </div>
    <div class="py-2 container">
        <a type="button" onclick="createDeviceGroup()" class="btn btn-primary btn-icon-split" data-toggle="modal" data-target="#createDeviceGroup">
            <span class="icon text-white-50">
                <i class="fas fa-plus"></i>
            </span>
            <span class="text">Thêm Nhóm Thiết Bị</span>
        </a>
        </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
     <!--Device Group Modal-->
    <div class="modal fade" id="modalDeviceGroup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
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
                            <label>Tên Nhóm Thiết Bị</label>
                            <input type="text" class="form-control form-control-user" id="dg_name" name="dg_name" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-primary" type="button" onclick="saveDeviceGroup()" id="btn-save_dg">Save</a>
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
    ajax: "{{ route('getManagerDeviceGroup') }}",
    columns: [
        {data: 'dg_id', name: 'dg_id'},
        {data: 'dg_name', name: 'dg_name'},
        {data: 'action'},
    ]
    });
});
    function reloadTable()
    {
        $('#dataTable').DataTable().ajax.reload();
    }

    function createDeviceGroup(){
        $("#ModalLabel").text("Tạo Nhóm Thiết Bị");
        $('#dg_name').val('');
        $('#btn-save_dg').attr('data-action', "create_deviceGroup");
        $('#modalDeviceGroup').modal('show');
    } 

    function editDeviceGroup(dg_id){
        $.ajax({
                    type:'GET',
                    url:"{{ route('findDeviceGroup') }}",
                    data:{
                        "dg_id":dg_id
                    },
                    success:function(data){
                        console.log(data.success);
                        $("#dg_name").val(data.success.dg_name);
                    },
                });
        $("#ModalLabel").text("Sửa Nhóm Thiết Bị");
        $('#btn-save_dg').attr('data-action',"edit_deviceGroup");
        $('#btn-save_dg').attr('data-dg_id', dg_id);
        $('#modalDeviceGroup').modal('show');    
    }

    function saveDeviceGroup(){
        const action = $("#btn-save_dg").attr('data-action');
        console.log(action);
        if(action == "create_deviceGroup")
        {
            const dg_name = $("#dg_name").val();
            $.ajax({
                type:'POST',
                url:"{{ route('createDeviceGroup') }}",
                data:{
                    "dg_name":dg_name
                },
                success:function(data){
                    alert(data.success);
                    $("#dg_name").val("");
                    reloadTable();
                },
            });
            
        }
        if(action == "edit_deviceGroup")
        {
            const dg_id = $("#btn-save_dg").attr('data-dg_id');
            const dg_name = $("#dg_name").val();
            $.ajax({
                type:'PUT',
                url:"{{ route('editDeviceGroup') }}",
                data:{
                    "dg_id":dg_id,
                    "dg_name":dg_name
                },
                success:function(data){
                    alert(data.success);
                    $('#modalDeviceGroup').modal('toggle');
                    reloadTable();
                },
            });
            
        }
        if(action != "create_deviceGroup" && action != "edit_deviceGroup")
        {
            console.log("ko xac dinh");
        }
    }

    function deleteDeviceGroup(dg_id)
    {
        var result = confirm("Xác nhận xoá nhóm thiết bị ?");
        if(result)  
        {
            $.ajax({
                type:'DELETE',
                url:"{{ route('deleteDeviceGroup') }}",
                data:{
                    "dg_id":dg_id
                },
                success:function(data){
                    reloadTable();
                },
            });
        } else {
        }
    }





@endsection