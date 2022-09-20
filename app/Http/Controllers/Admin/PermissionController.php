<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    public function index(){
        $permissions = Permission::all();
        return view('admin.permissions.index', compact('permissions'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate(['name' => ['required', 'min:3']]);
        Permission::create($validated);

        return to_route('admin.permissions.index')->with('message', 'წარმატებით დაემატა');
    }
    public function edit(Permission $permission)
    {
        $roles = Role::all();
        return view('admin.permissions.edit', compact('permission','roles'));
    }
    public function update(Request $request, Permission $permission)
    {
        $validated = $request->validate(['name' => ['required', 'min:3']]);
        $permission->update($validated);

        return to_route('admin.permissions.index')->with('message', 'წარმატებით განახლდა');;
    }

    public function destroy(Permission $permission)
    {
        $permission->delete();

        return back()->with('message', 'წარმატებით წაიშალა!');
    }

    public function assignRole(Request $request, Permission $permission)
    {
        if($permission->hasRole($request->role)){
            return back()->with('message', 'როლი არსებობს');
        }

        $permission->assignRole($request->role);
        return back()->with('message', 'ნებართვას როლი დაემატა');
    }

    public function removeRole(Permission $permission, Role $role)
    {
        if ($permission->hasRole($role)) {
            $permission->removeRole($role);
            return back()->with('message', 'როლი წაიშალა');
        }
        return back()->with('message', 'ნებართვაზე ეს როლი არ არსებობს');
    }
}
