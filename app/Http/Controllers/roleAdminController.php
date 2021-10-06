<?php

namespace App\Http\Controllers;

use App\Permission;
use App\Role;
use Illuminate\Http\Request;

class roleAdminController extends Controller
{
    private $role,$permission;
    public function __construct(Role $role,Permission $permission)
    {
        $this->permission =$permission;
        $this->role = $role;
    }

    public function index(){
        $roles = $this->role->get();
        return view('admin.role.index', compact('roles'));
    }

    public function edit($id){
        $role = $this->role->find($id);
        $permissions = $this->permission->where('parent_id',0)->get();
        return view('admin.role.edit', compact('role','permissions'));
    }
}
