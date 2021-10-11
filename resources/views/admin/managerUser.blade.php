@extends('layouts.admin')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Quản lý user</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Fullname</th>
                        <th>Username</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Fullname</th>
                        <th>Username</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ($user as $user)
                    <tr>
                        <td>{{$user->fullname}}</td>
                        <td>{{$user->username}}</td>
                        <td>{{$user->role_user}}</td>
                        <td>
                            <center>
                            <a class="btn btn-warning btn-circle btn-sm btn-reset_password" data-toggle="tooltip" title="Reset password"
                                data-user_id="{{$user->id}}">
                                <i class="fas fa-undo"></i>
                            </a>

                            <a type="button" class="btn btn-primary btn-circle btn-sm btn-get_user"  data-toggle="modal" data-target="#editUserModal" data-toggle="tooltip" title="Edit User"
                                data-user='{
                                    "id":"{{$user->id}}",
                                    "fullname":"{{$user->fullname}}",
                                    "username":"{{$user->username}}",
                                    "role":"{{$user->role_id}}"}'>
                                <i class="fas fa-user-edit"></i>
                            </a>

                            <a class="btn btn-danger btn-circle btn-sm" data-toggle="tooltip" title="Reset password">
                                <i class="fas fa-trash"></i>
                            </a>
                            </center>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- Edit User Modal-->
    <div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nhập thông tin cần sửa</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col-sm-12 mb-3 mb-sm-0">
                            <label>Fullname</label>
                            <input type="text" class="form-control form-control-user" id="fullname" name="fullname"
                                required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12 mb-3 mb-sm-0">
                            <label>Username</label>
                            <input type="text" class="form-control form-control-user" id="username" name="username"
                                required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12 mb-3 mb-sm-0">
                        <label>Phân Quyền</label>
                            <select class="custom-select form-control" id="role_id" name="role_id" required>
                                @foreach ($role as $role)
                                <option value="{{ $role->id}}">{{ $role->role_user}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <a class="btn btn-primary "  type="button" id="btn-edit_user">Save</a>
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<!-- JS -->
@section('script')

$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(".btn-get_user").click(function(){
        const user = JSON.parse($(this).attr("data-user"));
        console.log(user);
        $('#fullname').val(user.fullname);
        $('#username').val(user.username);
        $('#role_id').val(user.role);
        $("#btn-edit_user").data("id",user.id);
        console.log(user.id)
    });
    $("#btn-edit_user").click(function(){
        const user_id = $("#btn-edit_user").data("id");
        const fullname = $("#fullname").val();
        const username = $("#username").val();
        const role_id = $("#role_id").val();
        $.ajax({
           type:'PUT',
           url:"{{ route('user_edit') }}",
           data:{
               "user_id":user_id, 
               "fullname":fullname, 
               "username":username,
               "role_id":role_id
            },
           success:function(data){
              alert(data.success);
              location.reload();
           }
        });
    });
    
    $(".btn-reset_password").click(function(){
        const user_id = $(this).attr("data-user_id");
        $.ajax({
           type:'PUT',
           url:"{{ route('reset_password') }}",
           data:{
               "user_id":user_id
            },
           success:function(data){
              alert(data.success);
              <!-- location.reload(); -->
           }
        });
        console.log(user_id);
    });
});

@endsection