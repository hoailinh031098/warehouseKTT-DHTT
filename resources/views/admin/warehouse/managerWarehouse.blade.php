@extends('layouts.admin')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Kho Hàng</h6>
    </div>
    <div class="py-2 container">
        <a id="modal-create_warehouse" name="modal-create_warehouse" type="button" onclick="createWarehouse()" class="btn btn-primary btn-icon-split">
            <span class="icon text-white-50">
                <i class="fas fa-plus"></i>
            </span>
            <span class="text">Thêm Kho Hàng</span>
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover dataTable" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Managed By</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Managed By</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
    <!--Modal-->
    <div class="modal fade show" id="modalWarehouse" tabindex="-1" aria-hidden="true">
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
                            <label>Tên Kho Hàng</label>
                            <input type="text" class="form-control form-control-user" id="warehouse_name"
                                name="warehouse_name" required>
                        </div>
                        <div class="col-sm-12 mb-3 mb-sm-0">
                            <label>Người Quản Lý</label>
                            <select class="custom-select form-control" id="user_id" name="user_id" required>
                                <option value="0"><-- Select --></option>
                                @foreach ($user as $user)
                                <option value="{{ $user->id}}">{{ $user->fullname}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-primary" type="button" onclick="saveWarehouse()" id="btn-save_warehouse">Save</a>
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
        ajax: "{{ route('getManagerWarehouse') }}",
        columns: [
            {data: 'warehouse_id', name: 'warehouse_id'},
            {data: 'warehouse_name', name: 'warehouse_name'},
            {data: 'fullname', name: 'fullname'},
            {data: 'action'},
        ]
    });
});

    function reloadTable()
    {
        $('#dataTable').DataTable().ajax.reload();
    }

    function createWarehouse(){
        $("#ModalLabel").text("Tạo Kho Hàng");
        $('#warehouse_name').val('');
        $('#btn-save_warehouse').attr('data-action', "create_Warehouse");
        $('#modalWarehouse').modal('show');
    }

    function editWarehouse(warehouse_id)
    {
        $.ajax({
                type:'GET',
                url:"{{ route('findWarehouse') }}",
                data:{
                    "warehouse_id":warehouse_id
                },
                success:function(data){
                    $("#warehouse_name").val(data.success.warehouse_name);
                    $("#user_id").val(data.success.user_id);
                },
            });
        $('#modalWarehouse').modal('show');
        $("#ModalLabel").text("Sửa Kho Hàng");
        $('#btn-save_warehouse').attr('data-action', "edit_Warehouse");
        $('#btn-save_warehouse').attr('data-warehouse_id', warehouse_id);
    }

    function saveWarehouse()
    {
        const action = $("#btn-save_warehouse").attr('data-action');

        if(action == "create_Warehouse")
        {
            const warehouse_name = $("#warehouse_name").val();
            const user_id = $("#user_id").val();
            $.ajax({
                type:'POST',
                url:"{{ route('createWarehouse') }}",
                data:{
                    "warehouse_name":warehouse_name,
                    "user_id":user_id
                },
                success:function(data){
                    alert(data.success);
                    $("#warehouse_name").val("");
                    $("#user_id").val(0);
                    reloadTable();
                },
            });
            console.log(warehouse_name,user_id);
        }

        if(action == "edit_Warehouse")
        {
            const warehouse_id = $("#btn-save_warehouse").attr('data-warehouse_id');
            const warehouse_name = $('#warehouse_name').val();
            const user_id = $('#user_id').val();
            console.log(user_id);
            $.ajax({
                type:'PUT',
                url:"{{ route('editWarehouse') }}",
                data:{
                    "warehouse_id":warehouse_id,
                    "warehouse_name":warehouse_name,
                    "user_id":user_id
                },
                success:function(data){
                    alert(data.success);
                    console.log(data.success);
                    $('#modalWarehouse').modal('toggle');
                    reloadTable();
                },
            });
        }
    }

    function deleteWarehouse(warehouse_id)
    {
        var result = confirm("Xác nhận xoá kho hàng ?");
        if(result)  
        {
            $.ajax({
                type:'DELETE',
                url:"{{ route('deleteWarehouse') }}",
                data:{
                    "warehouse_id":warehouse_id
                },
                success:function(data){
                    reloadTable();
                },
            });
        } else {
        }
    }
@endsection