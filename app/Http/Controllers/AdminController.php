<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddUserAdminRequest;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Auth;
use Illuminate\Support\Facades\Hash;


class AdminController extends Controller
{
    private $role,$user;
    public function __construct(Role $role,User $user)
    {
        $this->role = $role;
        $this->user = $user;
    }

    public function login_admin(){
        $roles = $this->role->whereNotIn('id', [3])->get();
        return view('admin.login', compact('roles'));
    }

    public function show_form_register(){
        $roles = $this->role->whereNotIn('id', [3])->get();
        return view('admin.register', compact('roles'));
    }
    public function register(AddUserAdminRequest $request){
        $user =  $this->user->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'address' => $request->address,
            'phone' => $request->phone,
        ]);
        $roleId = $request->role_id;
        $user->roles()->attach($roleId);
        return redirect()->route('admins.admin_login')->with('message', 'Đăng ký thành công');
    }

    public function index(){
        if (auth()->check())
        {
            return view('admin.home');
        }else{
            return redirect()->route('admins.admin_login');
        }
    }

    public function post_login(Request $request){
        if (auth()->attempt([
            'email' => $request->email,
            'password' => $request->password
        ])){
            return redirect()->to('admin');
        }else{
            return redirect()->back()->with('message', 'Email hoặc mật khẩu không đúng')->withInput();
        }
    }

    public function log_out(){
        auth()->logout();
        return redirect()->route('admins.admin_login');
    }
}
