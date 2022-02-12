<?php

namespace App\Http\Controllers;

use App\Permission;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class roleAdminController extends Controller
{
    private $role, $permission, $user;

    public function __construct(Role $role, Permission $permission, User $user)
    {
        $this->permission = $permission;
        $this->role = $role;
        $this->user = $user;
    }

    public function index()
    {
        $roles = $this->role->latest()->paginate(5);
        return view('admin.role.index', compact('roles'));
    }

    public function create()
    {
        $permissions = $this->permission->where('parent_id', 0)->get();
        return view('admin.role.add', compact('permissions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'min:2', 'max:20', 'unique:roles'],
        ],
            [
                'name.required' => 'Tên không được trống',
                'name.unique' => 'Tên đã có',
                'name.max' => 'Tên không được dài hơn 20 ký tự',
                'name.min' => 'Tên không được ngắn hơn 2 ký tự',
            ]
        );
        $role = $this->role->create([
            'name' => $request->name,
        ]);
        $role->permissions()->attach($request->permission_id);
        return redirect()->route('roles.index')->with('message_success', 'Thêm quyền thành công');
    }

    public function edit($id)
    {
        $role = $this->role->find($id);
        $permissions_checked = $role->permissions;
        $permissions = $this->permission->where('parent_id', 0)->get();
        return view('admin.role.edit', compact('role', 'permissions', 'permissions_checked'));
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'name' => ['required', 'min:2', 'max:20', Rule::unique('roles')->ignore($id)],
        ],
            [
                'name.required' => 'Tên không được trống',
                'name.unique' => 'Tên đã có',
                'name.max' => 'Tên không được dài hơn 20 ký tự',
                'name.min' => 'Tên không được ngắn hơn 2 ký tự',
            ]
        );
        $this->role->find($id)->update([
            'name' => $request->name,
        ]);
        $role = $this->role->find($id);
        $permission_id = $request->permission_id;
        $role->permissions()->sync($permission_id);
        return redirect()->back()->with('message_role', 'cập nhật quyền thành công');
    }

    public function delete($id)
    {

        $role = $this->role->find($id);

        if ($role->name != 'Admin'){
            $this->role->find($id)->delete();
            return response()->json([
                'code' => 200,
                'message' => 'success'
            ], 200);
        }else{
            return response()->json([
                'code' => 500,
                'message' => 'success'
            ], 500);
        }


    }
}
