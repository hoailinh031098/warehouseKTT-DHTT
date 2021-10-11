@extends('layouts.admin')

@section('content')
<div class="card o-hidden border-0 shadow-lg my-5">
    <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
            <!-- <div class="col-lg-5 d-none d-lg-block bg-register-image"></div> -->
            <div class="col-lg-12">
                <div class="p-5">
                    <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4">Tạo Người Dùng</h1>
                    </div>
                    <form class="user" method="post" action="{{ route('user_create') }}">
                        @csrf
                        <div class="form-group row">
                            <div class="col-sm-12 mb-3 mb-sm-0">
                            <label>Fullname</label>
                                <input type="text" class="form-control" id="fullname" name="fullname"required>
                            </div>
                        </div>
                        <div class="form-group">
                        <label>Username</label>
                            <input type="text" class="form-control " id="username" name="username"required>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                            <label>Password</label>
                                <input type="password" class="form-control " id="password"
                                    name="password"required>
                            </div>
                            <div class="col-sm-6">
                            <label>Phân Quyền</label>
                                <select class="custom-select form-control" id="role_id" name="role_id" required>
                                    <option></option>
                                    @foreach ($role as $role)
                                    <option value="{{ $role->id}}">{{ $role->role_user}}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-user btn-block">
                            Create User
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection