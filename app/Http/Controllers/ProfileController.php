<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    

    public function index()
    {
        $profiles = Profile::with('user')->latest()->paginate(10);
        return view('profiles.index', compact('profiles'));
    }

    
    

    public function create()
    {
        Gate::authorize('admin');

        $users = User::doesntHave('profile')->orderBy('name')->get();

        return view('profiles.create', compact('users'));
    }

   
    

    public function store(Request $request)
    {
        Gate::authorize('admin');

        $validated = $request->validate([
            'user_id' => 'required|exists:users,id|unique:profiles,user_id',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'avatar' => 'nullable|image|max:2048', // maksimal 2 MB
            'birth_date' => 'nullable|date|before:today',
        ]);

       
        
        if ($request->hasFile('avatar')) {
            $validated['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }

        Profile::create($validated);

        return redirect()->route('profiles.index')->with('success', 'Profil berhasil ditambahkan.');
    }

    
    

    public function show(Profile $profile)
    {
        $profile->load('user');
        return view('profiles.show', compact('profile'));
    }

    
    

    public function edit(Profile $profile)
    {
        Gate::authorize('admin');

        $users = User::doesntHave('profile')->orWhere('id', $profile->user_id)->orderBy('name')->get();

        return view('profiles.edit', compact('profile', 'users'));
    }

   
    

    public function update(Request $request, Profile $profile)
    {
        Gate::authorize('admin');

        $validated = $request->validate([
            'user_id' => 'required|exists:users,id|unique:profiles,user_id,' . $profile->id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'avatar' => 'nullable|image|max:2048',
            'birth_date' => 'nullable|date|before:today',
        ]);

        if ($request->hasFile('avatar')) {
            if ($profile->avatar) {
                Storage::disk('public')->delete($profile->avatar);
            }
            $validated['avatar'] = $request->file('avatar')->store('avatars', 'public');
        } else {
           
            unset($validated['avatar']);
        }

        $profile->update($validated);

        return redirect()->route('profiles.index')->with('success', 'Profil berhasil diupdate.');
    }

    
    

    public function destroy(Profile $profile)
    {
        Gate::authorize('admin');

        if ($profile->avatar) {
            Storage::disk('public')->delete($profile->avatar);
        }

        $profile->delete();

        return redirect()->route('profiles.index')->with('success', 'Profil berhasil dihapus.');
    }
}
