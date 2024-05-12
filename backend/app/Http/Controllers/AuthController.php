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
        $roles = Role::all();
        return view('auth.register', compact('roles'));
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
            'name' => 'required|string|max:255',
            'username' => ['required', 'string', 'max:255', Rule::unique('users', 'username')],
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6|max:16|confirmed',

            'role' => 'required|exists:roles,id', // Ensure the selected role exists

            'photo' => 'nullable|image'
        ]);

        // Handle the photo upload
        if (request()->hasFile('photo') && request()->file('photo')->isValid()) {
            $cleanData['photo'] = request()->file('photo')->store('images', 'public');
        } else {
            unset($cleanData['photo']); // Remove photo from array if not uploaded
        }

        // Encrypt the password before storing it
        $cleanData['password'] = bcrypt($cleanData['password']);

        unset($cleanData['role']);

        $user = User::create($cleanData);

        // $role = Role::where('name', 'Employee')->first();
        $role = Role::findOrFail(request('role'));;

        if ($role) {
            $user->roles()->attach($role);
        } else {
            // Optionally handle the error if the role does not exist
            return redirect()->back()->withErrors(['role' => 'The specified role does not exist.']);
        }

        // auth()->login($user);

        return redirect('/')->with('success', 'Successfully Create New User ' . $user->name);
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

        // auth()->login($user);
        return redirect('/')->with('success', 'Updated profile for  ' . $user->name);
    }


    public function logout()
    {
        auth()->logout();
        return redirect('/')->with('success', 'Good Bye');
    }
}