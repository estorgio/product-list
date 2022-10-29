<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class UserController extends Controller
{
    use SoftDeletes;

    public function signup()
    {
        return view('users.signup');
    }

    public function store(UserRequest $request)
    {
        $formFields = $request->validated();

        $formFields['password'] = Hash::make($formFields['password']);

        $user = User::create($formFields);

        event(new Registered($user));

        auth()->login($user);

        return redirect('/');
    }

    public function login()
    {
        return view('users.login');
    }

    public function authenticate(Request $request)
    {
        $formFields = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $remember = $request->has('remember_me');

        if (auth()->attempt($formFields, $remember)) {
            $request->session()->regenerate();
            return redirect('/')->with('message', 'Welcome back, ' . auth()->user()->username);
        }

        return back()
            ->withErrors(['password' => 'Invalid username or password'])
            ->onlyInput('username');
    }

    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('message', 'You have been logged out.');
    }

    public function require_verification()
    {
        return redirect('/');
    }

    public function verify_account(EmailVerificationRequest $request)
    {
        $request->fulfill();
        return redirect('/')
            ->with('message', 'Your email has been successfully verified.');
    }
}
