<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login_form()
    {
        return view('auth.login');
    }

    public function register_form()
    {
        return view('auth.register');
    }

    public function register_moderator_form()
    {
        return view('auth.register-moderator');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');
        $remember = $request->filled('remember');

        if (Auth::attempt($credentials, $remember)) {
            if (auth()->user() !== null && auth()->user()->approve_status === 'PENDING') {
                Auth::logout();

                return redirect()->back()
                    ->with('error', 'Your account is pending approval. Check back later.');
            }

            if (auth()->user() !== null && auth()->user()->approve_status === 'REJECTED') {
                Auth::logout();

                return redirect()->back()
                    ->with('error', 'Your account is rejected from entering our website');
            }

            if (auth()->user() !== null && auth()->user()->role != null && auth()->user()->role->name === 'ADMIN') {
                return redirect()->route('admin.dashboard');
            } else {
                return redirect('/');
            }
        } else {
            return redirect()->back()
                ->with('error', 'Invalid credentials');
        }
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required|unique:users,phone',
            'username' => 'required|unique:users,username',
            'dob' => 'required',
            'country' => 'required',
            'JMBG' => 'required|unique:users,JMBG',
            'avatar' => 'required|image|mimes:jpg,png|max:2048',
            'gender' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed',
        ]);

        $response = cloudinary()->upload($request->file('avatar')->getRealPath(), [
            'verify' => false
        ])->getSecurePath();

        $user = User::create($request->only(
            'name',
            'phone',
            'username',
            'dob',
            'country',
            'JMBG',
            'email',
            'gender'
        ) + [
            'password' => bcrypt($request->password),
            'avatar' => $response
        ]);

        return redirect('/')
            ->with('success', 'Account created successfully! Now you need to wait for approval.');
    }

    public function register_moderator(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required|unique:users,phone',
            'username' => 'required|unique:users,username',
            'dob' => 'required',
            'country' => 'required',
            'JMBG' => 'required|unique:users,JMBG',
            'avatar' => 'required|image|mimes:jpg,png|max:2048',
            'gender' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed',
        ]);

        $response = cloudinary()->upload($request->file('avatar')->getRealPath(), [
            'verify' => false
        ])->getSecurePath();

        $user = User::create($request->only(
            'name',
            'phone',
            'username',
            'dob',
            'country',
            'JMBG',
            'email',
            'gender'
        ) + [
            'password' => bcrypt($request->password),
            'avatar' => $response,
            'role_id' => Role::where('name', 'MODERATOR')->first()->id
        ]);

        return redirect('/')
            ->with('success', 'Account created successfully! Now you need to wait for approval.');
    }


    public function logout()
    {
        Auth::logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect('/');
    }
}
