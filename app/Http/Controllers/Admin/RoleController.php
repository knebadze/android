<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::whereNotIn('name', ['admin'])->get();
        return view('admin.roles.index', compact('roles'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate(['name' => ['required', 'min:3']]);
        Role::create($validated);

        return to_route('admin.roles.index')->with('message', 'წარმატებით დაემატა!');
    }
    //edit
    public function edit(Role $role)
    {
        $permissions = Permission::all();
        return view('admin.roles.edit', compact('role','permissions'));
    }
    //update
    public function update(Request $request, Role $role)
    {
        $validated = $request->validate(['name' => ['required', 'min:3']]);
        $role->update($validated);

        return to_route('admin.roles.index')->with('message', 'წარმატებით განახლდა!');
    }
    //destroy
    public function destroy(Role $role)
    {
        $role->delete();

        return back()->with('message', 'წარმატებით წაიშალა!');
    }
    //add role_permission
    public function givePermission(Request $request, Role $role)
    {
        if ($role->hasPermissionTo($request->permission)) {
            return back()->with('message', 'ნებართვა არსებობს!');
        }
        $role->givePermissionTo($request->permission);
        return back()->with('message', 'ნებართვა დაემატა!');
    }
    //delete Role_permission
    public function revokePermission(Role $role, Permission $permission)
    {
        if ($role->hasPermissionTo($permission)) {
            $role->revokePermissionTo($permission);
            return back()->with('message', 'ნებართვა წაიშალა!');
        }
        return back()->with('message', 'როლს ნებართვა არ აქვს მინიჭებული!');
    }
}
