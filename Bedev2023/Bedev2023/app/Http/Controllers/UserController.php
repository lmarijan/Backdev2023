<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{

    //show all users
    public function index(User $user)
    {
        if (auth()->user()->role_id == 1) {
            return view('users.index', ['users' => $user::all()]);
        }
        return view('users.index', ['users' => [$user::find(auth()->user()->id)]]); //tu je user:find stavljen u array jer mora biti array tip podatka a metoda ga ne vrace
    }

    //show register/create form
    public function create()
    {
        return view('users.register');
    }

    //create user
    public function store(Request $request)
    {
        $formFields = $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', Rule::unique("users", "email")],
            'password' => 'required|confirmed|min:6'
        ]);

        //hash password
        $formFields['password'] = bcrypt($formFields['password']);

        //set default role
        $formFields['role_id'] = 2;

        $user = User::create($formFields);

        //login
        auth()->login($user);

        return redirect('/')->with('message', 'User created and logged in');
    }

    //show edit form
    public function edit(User $user)
    {
        if (auth()->user()->role_id == 1 || $user->id == auth()->id()) { //samo admin moze editirati svih a editor samo sebe
            return view('users.edit', ['user' => $user]);
        } else {
            abort('403', 'Unauthorized Action');
        }
    }

    //update user data
    public function update(Request $request, User $user)
    {
        if (auth()->user()->role_id == 1 || $user->id == auth()->id()) { // ovaj uvjet je mozda bilo samo dovoljno staviti u show edit form rutu ali mozda je ovo neka dodatna sigurnost

            $formFields = $request->validate([
                'name' => 'required',
                'email' => ['required', Rule::unique('users', 'email')->ignore($user->id)],
            ]);

            if (auth()->user()->role_id == 1 && request()->role_id != null) { //ovo je neki dodatni uvjet u slucaju da korisnik napravi custom formu pomocu koje bi ostvario prava koja mu nisu dozvoljena
                $formFields['role_id'] = request()->role_id;
            }

            $user->update($formFields);
            return redirect('/')->with('message', 'User updated succesfully!');
        } else {
            abort('403', 'Unauthorized Action');
        }
    }

    //delete post
    public function destroy(User $user)
    {
        if (auth()->user()->role_id == 1 || $user->id == auth()->id()) { //samo admin moze brisati svih a editor samo sebe
            $user->delete();
            return redirect('/')->with('message', 'User deleted successfully');
        } else {
            abort('403', 'Unauthorized Action');
        }
    }

    //logout
    public function logout(Request $request)
    {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message', 'You have been logged out!');
    }

    //show login form
    public function login()
    {
        return view('users.login');
    }

    //authenticate user
    public function authenticate(Request $request)
    {
        $formFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required'
        ]);

        if (auth()->attempt($formFields)) {
            $request->session()->regenerate();
            return redirect('/')->with('message', 'You are now logged in!');
        }

        return back()->withErrors(['email' => 'Invalid Credentials!'])->onlyInput('email');
    }
}
