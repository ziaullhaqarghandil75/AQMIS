<?php

namespace App\Http\Controllers\UserSettings;

use App\DataTables\UserDataTable;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserSettings\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(UserDataTable $dataTable)
    {
        if (!(Auth::user()->can('view_user'))) {
            return view('layouts.403');
        }
        $roles      = Role::get();
        return $dataTable->render('user_settings.users.index', compact('roles'));
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
        if (!(Auth::user()->can('add_user'))) {
            return view('layouts.403');
        }
        $request->validate([
            'name' => ['required', 'string'],
            'phone' => ['required', 'min:10', 'numeric', 'unique:' . User::class],
            'image' => ['mimes:jpg,png,JPG,PNG'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'role_id' => ['required', 'exists:roles,id'],
        ]);

        $user = new User();
        if ($request->has('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $path = 'images/users/';
            $file->move($path, $filename);
            $user->img = $path . $filename;
        }
        $user->name = $request->name;
        $user->last_name = $request->last_name;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->password = Hash::make('user@123');
        $user->status = $request->status;
        $user->password_change_status = $request->password_status == 'on' ? '1' : '0';
        if ($request->password_status != '1') {
            $user->password_changed_at = now();
        }
        $user->save();

        $user->roles()->sync($request->input('role_id'));

        return redirect()->route('users.index')->with('success', 'کاربر جدید اضافه کردید.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::with('roles')->findOrFail($id);
        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (!(Auth::user()->can('edit_user'))) {
            return view('layouts.403');
        }
        $request->validate([
            'name' => ['required', 'string'],
            'phone' => ['required', 'min:10', 'numeric', 'unique:' . User::class . ',phone,' . $id],
            'image' => ['mimes:jpg,png,JPG,PNG'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class . ',email,' . $id],
        ]);

        $user = User::findOrFail($id);
        if ($request->hasFile('image')) {
            if ($user->img && file_exists(public_path($user->img))) {
                unlink(public_path($user->img));
            }
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $path = 'images/users/';
            $file->move($path, $filename);
            $user->img = $path . $filename;
        }

        $user->name = $request->name;
        $user->last_name = $request->last_name;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->status = $request->status;
        $user->password_change_status = $request->password_status == 'on' ? '1' : '0';
        if ($request->password_status == '0') {
            $user->password_changed_at = now();
        }
        $user->save();

        if ($request->has('role_id')) {
            $user->roles()->sync($request->input('role_id'));
        }
        return redirect()->route('users.index')->with('success', 'کاربر با موفقیت تصحیح گردید.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (!(Auth::user()->can('delete_user'))) {
            return view('layouts.403');
        }
        User::findOrFail($id)->delete();
        return redirect()->back()->with('warning', 'کاربر حذف گردید!');
    }
    public function profile($user_id = null)
    {
        if ($user_id) {
            if (!(Auth::user()->can('view_user'))) {
                return view('layouts.403');
            }
            $user = User::findOrFail($user_id);
            return view('profile.user_profile', compact('user'));
        } else {
            $user = User::findOrFail(auth()->user()->id);
            return view('profile.user_profile', compact('user'));
        }
    }

    public function update_profile(Request $request)
    {
        if (!Auth::user()->can('edit_profile')) {
            return view('layouts.403');
        }
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string',
            'last_name' => 'nullable|string',
            'phone' => 'nullable|min:10|max:20|unique:users,phone,' . $user->id,
            'img' => 'nullable|mimes:png,jpg,jpeg|max:2048',
        ]);

        if ($request->hasFile('img')) {
            if ($user->img && file_exists(public_path($user->img))) {
                unlink(public_path($user->img));
            }

            $file = $request->file('img');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $path = 'images/users/';
            $file->move(public_path($path), $filename);

            $user->img = $path . $filename;
        }

        $user->update([
            'name' => $request->name,
            'last_name' => $request->last_name,
            'phone' => $request->phone,
        ]);

        return redirect()->back()->with('success', 'پروفایل شما تصحیح گردید.');
    }

    public function user_status($user_id)
    {
        if (!Auth::user()->can('active_inactive')) {
            return view('layouts.403');
        }
        $user = User::findOrFail($user_id);

        $newStatus = $user->status == '1' ? '0' : '1';
        $user->update(['status' => $newStatus]);

        $message = $newStatus == '1' ? 'کاربر فعال شد.' : 'کاربر غیرفعال شد.';

        return redirect()->back()->with('success', $message);
    }

    public function logout_specific_user($userId)
    {
        if (!(Auth::user()->can('logout_specific_user'))) {
            return view('layouts.403');
        }
        $user = User::find($userId);

        if ($user) {
            $userSessions = \DB::table('sessions')
                ->where('user_id', $user->id)
                ->get();

            foreach ($userSessions as $session) {
                \DB::table('sessions')->where('id', $session->id)->delete();
            }
            return redirect()->back()->with('success', 'کاربر با موفقیت خارج شد.');
        } else {
            return redirect()->back()->with('warning', 'کاربر پیدا نشد.');
        }
    }
}
