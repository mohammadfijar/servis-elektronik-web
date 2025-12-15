<?php

// app/Http/Controllers/AuthController.php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{
    /** Show login form */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /** Process login */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required','email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended($this->redirectTo(Auth::user()));
        }

        return back()->withErrors(['email' => 'Email atau password salah']);
    }

    /** Determine post‐login redirect based on role */
    protected function redirectTo(User $user)
    {
        if ($user->hasRole('owner')) {
            return route('dashboard.owner');
        }
        if ($user->hasRole('admin')) {
            return route('dashboard.admin');
        }
        if ($user->hasRole('staff')) {
            return route('dashboard.staff');
        }
        return route('dashboard');
    }

    /** Show register form */
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    /** Process registration */
    public function register(Request $request)
    {
        $data = $request->validate([
            'name'     => ['required','string','max:255'],
            'email'    => ['required','email','unique:users'],
            'password' => ['required','confirmed','min:6'],
        ]);

        $user = User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        if ($role = Role::where('name', 'staff')->first()) {
            $user->roles()->attach($role);
        }

        Auth::login($user);
        return redirect($this->redirectTo($user));
    }

    /** Logout user */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login.show');
    }

    /** Show profile page */
    public function showProfile()
    {
        return view('auth.profile', ['user' => Auth::user()]);
    }

    /** Update profile */
    public function updateProfile(ProfileUpdateRequest $request)
    {
        $user = Auth::user();
        $data = $request->validated();

        $user->fill([
            'name'  => $data['name'],
            'email' => $data['email'],
        ]);

        if (!empty($data['password'])) {
            $user->password = Hash::make($data['password']);
        }

        if ($request->hasFile('photo')) {
            // Hapus foto lama
            if ($user->photo && Storage::exists('public/'.$user->photo)) {
                Storage::delete('public/'.$user->photo);
            }
            $user->photo = $request->file('photo')->store('photos','public');
        }

        $user->save();

        return redirect()->route('profile.show')
                         ->with('success','Profil berhasil diperbarui');
    }
}
