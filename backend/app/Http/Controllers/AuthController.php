<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function login()
    {
        return view('auth.login');
    }

    public function loginStore(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if (auth()->attempt($credentials)) {
            return redirect('/')->with('success', 'Welcome Back ' . auth()->user()->name);
        } else {
            return back()->withInput($request->only('email'))->withErrors([
                'email' => 'Invalid credentials',
            ]);
        }
    }


    public function store()
    {
        $cleanData = request()->validate([
            'name' => ['required'],
            'username' => ['required', Rule::unique('users', 'username')],
            'email' => ['required'],
            'password' => ['required', 'min:6', 'max:16', 'confirmed'],
            'photo' => ['image']
        ]);
        $cleanData['photo'] = request()->file('photo')->store('/images');

        $user = User::create($cleanData);

        // Get the appropriate role (e.g., 'Employee')
        $role = Role::where('name', 'Employee')->first();

        // Attach the role to the user
        $user->roles()->attach($role);

        auth()->login($user);
        return redirect('/')->with('success', 'Welcome to creativecoder ' . $user->name);
    }

    public function update(User $user)
    {

        $cleanData = request()->validate([
            'name' => ['required'],
            'username' => ['required', Rule::unique('users', 'username')->ignore(auth()->user()->id)],
            'email' => ['required'],
            // 'password' => ['required', 'min:6', 'max:16', 'confirmed']
        ]);

        $user->update($cleanData);

        // Get the appropriate role (e.g., 'Employee')
        // $role = Role::where('name', 'Employee')->first();

        // Attach the role to the user
        // $user->roles()->attach($role);

        auth()->login($user);
        return redirect('/')->with('success', 'Updated profile for  ' . $user->name);
    }


    public function logout()
    {
        auth()->logout();
        return redirect('/')->with('success', 'Good Bye');
    }
}