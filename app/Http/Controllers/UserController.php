<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function index()
    {
        $users = User::with('roles')->simplePaginate(10);
        return view('users.index', compact('users'));
    }

    public function create()
    {
        // only admin and staff roles
        $roles = Role::whereIn('name', ['admin', 'staff'])->get();
        return view('users.create', compact('roles'));
    }

    public function store(StoreUserRequest $request)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);
        $user->roles()->sync($data['roles']);

        return redirect()->route('users.index')
                         ->with('success', 'User berhasil ditambahkan');
    }

    public function show(User $user)
    {
        $user->load('roles');
        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        $roles = Role::whereIn('name', ['admin', 'staff'])->get();
        $user->load('roles');
        return view('users.edit', compact('user', 'roles'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $data = $request->validated();
        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }
        $user->update($data);
        $user->roles()->sync($data['roles']);

        return redirect()->route('users.index')
                         ->with('success', 'User berhasil diupdate');
    }

    public function destroy(User $user)
    {
        $user->roles()->detach();
        $user->delete();
        return redirect()->route('users.index')
                         ->with('success', 'User berhasil dihapus');
    }
}
