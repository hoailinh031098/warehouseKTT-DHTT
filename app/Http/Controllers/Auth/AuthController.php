<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Auth;
use Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Auth\Authenticatable;

class AuthController extends Controller
{
    public function indexlogin()
    {
      return view('auth/login');
    }

    public function authenticate(Request $request)
    {
        // $user = DB::table('users')->where('username', $username)->get();
        if(Auth::check())
        {
          $user=Auth::user();
          if($user->role_id == 1){
            return redirect('/admin/homepage');
          } if($user->role_id == 2){
            return redirect('/UserDHTT/homepage');
          } if($user->role_id == 3){
            return "User KTT kho";
          } if($user->role_id == 4){
            return "User Sua Chua";
          }
        }else{
          return redirect('login');
        }
    }

    public function login(Request $request){
        $username = $request->username;
        $credentials = $request->only('username', 'password');
      if(Auth::attempt($credentials)){
        $user=Auth::user();
        // return $user;
        if($user->role_id == 1){
          return redirect('/admin/homepage');
        } if($user->role_id == 2){
          return redirect('/UserDHTT/homepage');
        } if($user->role_id == 3){
          return "User KTT kho";
        } if($user->role_id == 4){
          return "User Sua Chua";
        }
      }
      else{
        return redirect('login')->withErrors(['user' => 'Sai username hoặc password']);
      }
    }


    public function logout() {
      Auth::logout();
      return redirect('/login');
    }

    public function page404()
    {
      return view('404');
    }
}