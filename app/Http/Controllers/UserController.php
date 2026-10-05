<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Unique;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('profile')->paginate(8);
        return view('users.index', compact('users'));
    }


    public function create()
    {
        Gate::authorize('admin');
        return view('users.create');
    }


    public function store(Request $request)
    {
        Gate::authorize('admin');

        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'role' => 'required|in:admin,user',
        ]);

        $validated['password'] = Hash::make($request->password);

        User::create($validated);

        return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan');
    }


    public function show(User $user)
    {
        $user->load(['profile', 'teacher', 'student', 'announcements']);
        return view('users.show', compact('user'));
    }


    public function edit(User $user)
    {
        Gate::authorize('admin');
        return view('users.edit', compact('user'));
    }


    public function update(Request $request, User $user)
    {
        Gate::authorize('admin');

        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable',
            'role' => 'required|in:admin,user'
        ]);

        if ($request->filled('password')) {
            $validated['password'] = Hash::make($request->password);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        return redirect()->route('users.index')->with('success', 'User berhasil diupdate');
    }



    public function destroy(User $user)
    {
        //
    }
}
