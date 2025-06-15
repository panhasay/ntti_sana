<?php

namespace App\Http\Controllers\Permission;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function create()
    {
        $roles = Role::all();
        return view('permissions.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:permissions,name',
            'roles' => 'array|nullable',
        ]);

        $permission = Permission::create(['name' => $request->name]);

        if ($request->roles) {
            foreach ($request->roles as $roleId) {
                $role = Role::findById($roleId);
                $role->givePermissionTo($permission);
            }
        }

        return response()->json(['success' => 'Permission created and assigned successfully!']);
    }
}
