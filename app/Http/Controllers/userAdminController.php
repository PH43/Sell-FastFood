<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddUserAdminRequest;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class userAdminController extends Controller
{
    private $user, $role;
    public function __construct(User $user, Role $role)
    {
        $this->role = $role;
        $this->user = $user;
    }

    public function index(){
        $users = $this->user->latest()->paginate(5);
        return view('admin.user.index', compact('users'));
    }

    public function create(){
        $roles = $this->role->whereNotIn('id', [3])->get();
        return view('admin.user.add',compact('roles'));

    }

    public function store(AddUserAdminRequest $request){
        $user =  $this->user->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'address' => $request->address,
            'phone' => $request->phone,
        ]);
        $roleId = $request->role_id;
        $user->roles()->attach($roleId);
        return redirect()->route('users.index');
    }

    public function edit($id){
        $roles = $this->role->whereNotIn('id', [3])->get();
        $user = $this->user->find($id);
        $role_of_user = $user->roles;
        foreach ($user->roles as $role_user){
            if ($role_user->id == 3){
                $role_user_check = 3;
            }
            else{
                $role_user_check = '';
            }
        }
        return view('admin.user.edit',compact('roles', 'user', 'role_user_check','role_of_user'));
    }

    public function update($id, Request $request){

        $request->validate([
            'name' => ['required', 'min:2', 'max:20', Rule::unique('users')->ignore($id),],
            'email' => ['required',Rule::unique('users')->ignore($id),],
            'role_id' => 'required',
            'address' => 'required',
            'phone' => 'required|numeric',
        ],
            [
                'name.required' => 'Tên không được trống',
                'name.unique' => 'Tên đã có',
                'name.max' => 'Tên không được dài hơn 20 ký tự',
                'name.min' => 'Tên không được ngắn hơn 2 ký tự',
                'email.required' => 'Email không được trống',
                'email.unique' => 'Email đã có',
                'role_id.required' => 'Chức vụ không được trống',
                'address.required' => 'Địa chỉ không được trống',
                'phone.required' => 'Số điện thoại không được trống',
                'phone.numeric' => 'Số điện thoại phải là số',
            ]
        );

        $this->user->find($id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'address' => $request->address,
            'phone' => $request->phone,
        ]);
        $user = $this->user->find($id);
        $roleId = $request->role_id;
        $user->roles()->sync($roleId);
        return redirect()->route('users.index');
    }

    public function delete($id){
        $this->user->find($id)->delete();
        return response()->json([
            'code' => 200,
            'massage' => 'success'
        ], 200);
    }
}
