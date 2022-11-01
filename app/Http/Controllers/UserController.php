<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
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

    public function forgot_password_form()
    {
        return view('users.forgot-password');
    }

    public function email_password_reset_link(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? redirect()->route('login')->with('message', 'A password reset link has been sent to your email.')
            : back()->with('message', 'An error occured while trying to send password reset link to your email.');
    }

    public function password_reset_form(Request $request, $token)
    {
        return view('users.reset-password', [
            'token' => $token,
            'email' => $request->query('email'),
        ]);
    }

    public function reset_password(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->password = Hash::make($password);
                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('message', 'Your password has been successfully changed.')
            : back()->with('message', 'An error occured while trying to change your password.');
    }
}
