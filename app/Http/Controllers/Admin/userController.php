<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Hash;
class userController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        return view('admin/home');
    }
    //====================Manager User Begin=======================//
    public function index_userCreate()
    {
        $role = DB::table('role')->distinct()->get();
        return view('admin/createUser',['role'=>$role]);
    }

    public function action_userCreate(Request $request)
    {
        $user = new User;
        $user->fullname = $request->fullname;
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->role_id = $request->role_id;
        $user->save();
        return redirect('/admin/user/create');
    }

    public function index_userManager()
    {
        $user = DB::table('users')
            ->join('role', 'users.role_id', '=', 'role.id')
            ->select('users.*', 'role.role_user')->get();
        $role = DB::table('role')->get();
        return view('admin/managerUser',[
            'user'=>$user,
            'role'=>$role
        ]);
    }

    public function edit_user(Request $request)
    {
            $user =  User::where('id', $request->user_id)->first();
            $user->fullname = $request->fullname;
            $user->username = $request->username;
            $user->role_id = $request->role_id;
            $user->save();
            return response()->json(['success'=>"Cập nhật thành công !!!"]);
    }
    public function reset_password(Request $request)
    {
        $user =  User::where('id', $request->user_id)->first();
        $user->password = Hash::make("Vnpt@123");
        $user->save();
        return response()->json(['success'=>"Password đã được cập nhật Vnpt@123"]);
    }
    
}