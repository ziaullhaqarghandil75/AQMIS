<?php

namespace App\Http\Controllers\UserSettings;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\UserSettings\Role;
use App\Http\Controllers\Controller;
use App\Models\UserSettings\PermissionCategory;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!(Auth::user()->can('view_role'))) {
            return view('layouts.403');
        }
        $roles = Role::select('id', 'name','description','status')->orderBy('id', 'desc')->get();
        $users = User::select('id', 'name', 'last_name', 'email', 'phone', 'status', 'img')->with('roles')->get();

        return view('user_settings.role.index', compact('roles','users'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!(Auth::user()->can('add_role'))) {
            return view('layouts.403');
        }
        $request->validate([
            'name' => ['required', 'string'],
            'description' => ['required', 'string'],
            'status' => ['required', 'in:on,off'],
        ]);

        $role                 = new Role();
        $role->name           = $request->name;
        $role->description    = $request->description;
        $role->status         = $request->status === 'on' ? '1' : '0';
        $role->save();

        return redirect()->back()->with('success', 'سطح دسترسی شما اضافه شد.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if (!(Auth::user()->can('add_permission_to_role'))) {
            return view('layouts.403');
        }
        $role = Role::with('permissions')->select('id', 'name','description','status')->find($id);

        $permission_categories = PermissionCategory::with('permissions')->select('id', 'name')->orderBy('id', 'desc')->get();

        return view('user_settings.role.permisstion_role', compact('role','permission_categories'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (!(Auth::user()->can('add_permission_to_role'))) {
            return view('layouts.403');
        }
        $role = Role::findOrFail($id);

        $role->Permissions()->sync($request->input('permission_id'));

        return redirect()->route('roles.index')->with('success', 'سطح دسترسی تصحیح شد.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (!(Auth::user()->can('delete_role'))) {
            return view('layouts.403');
        }
        Role::findOrFail($id)->delete();
        return redirect()->back()->with('warning','سطح دسترسی حذف گردید!');
    }
}
