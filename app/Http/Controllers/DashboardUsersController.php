<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Spatie\Permission\Models\Role;

class DashboardUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('users.index', [
            'users' => User::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create', [
            'roles' => Role::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'role' => ['required'],
            'password' => ['required', 'min:8'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole($request->role);

        return Redirect::to('/dashboard/users')->with('success', 'User has been add!');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('users.edit', [
            'user' => $user,
            'roles' => Role::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user, Role $role)
    {
        $check_data = [
            'name' => ['required', 'string', 'max:255'],
            'password' => ['nullable', 'min:8'],
        ];

        // Jika input email berbeda dengan email yang ada, tambahkan validasi unik
        if ($request->email != $user->email) {
            $check_data['email'] = ['required', 'string', 'lowercase', 'email', 'max:255'];
        }

        $validateData = $request->validate($check_data);
        if ($request->password != '') {
            $validateData['password'] = bcrypt($request->password);
        } else {
            unset($validateData['password']); // Hapus password dari data yang akan diupdate jika tidak ada input password
        }

        User::where('id', $user->id)->update($validateData);
        $user->syncRoles([$request->role]);

        return Redirect::to('/dashboard/users')->with('success', 'User has been update!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        User::destroy($user->id);
        return Redirect::to('/dashboard/users')->with('success', 'User has been delete!');
    }
}
