<?php

namespace App\Http\Controllers\UserSettings;

use App\Http\Controllers\Controller;
use App\Models\UserSettings\Permission;
use App\Models\UserSettings\PermissionCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!(Auth::user()->can('view_permissions'))) {
            return view('layouts.403');
        }
        $permission_categories = PermissionCategory::with('permissions')->select('id', 'name')->orderBy('id', 'desc')->get();

        return view('user_settings.permission.index', compact('permission_categories'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!(Auth::user()->can('add_permission'))) {
            return view('layouts.403');
        }
        $request->validate([
            'name_fa' => ['required', 'string'],
            'name_en' => ['required', 'string'],
            'permission_category_id' => ['required', 'exists:permission_categories,id'],
        ]);
        // dd();

        $permission                         = new Permission();
        $permission->name                   = $request->name_en;
        $permission->description            = $request->name_fa;
        $permission->permission_category_id = $request->permission_category_id;
        $permission->save();

        return redirect()->back()->with('success', 'سطوح دسترسی شما اضافه شد.');
    }


    public function add_permission_category(Request $request)
    {
        if (!(Auth::user()->can('add_permission_category'))) {
            return view('layouts.403');
        }
        $request->validate([
            'name' => 'required|string|unique:permission_categories,name',
        ]);
        PermissionCategory::create([
            'name' => $request->name,
        ]);

        return redirect()->back()->with('success', 'معلومات شما ذخیره گردید!');
    }
}
