<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\SeekerRegistrationRequest;

class UserController extends Controller
{
    const JOB_SEEKER = 'seeker';
    const JOB_POSTER = 'employer';

    public function createSeeker() {
        return view('user.seeker-register');
    }

    public function createEmployer() {

        return view('user.employer-register');

    }

    public function storeSeeker(SeekerRegistrationRequest $request) {

       User::create([

        'name' => request('name'),
        'email' => request('email'),
        'password' => bcrypt(request('password')),
        'user_type' => self::JOB_SEEKER

       ]);

       return back();

    }

    public function storeEmployer(SeekerRegistrationRequest $request) {

        User::create([
 
         'name' => request('name'),
         'email' => request('email'),
         'password' => bcrypt(request('password')),
         'user_type' => self::JOB_POSTER
 
        ]);
 
        return back();
 
     }

    public function login() {

        return view('user.login');

    }

    public function postLogin(Request $request) {

        $request->validate([

            'email' => 'required',
            'password' => 'required',

        ]);

        $credentials = $request->only('email', 'password');

        if(Auth::attempt($credentials)) {

            return redirect()->intended('/dashboard');

        }

        return "wrong email or password";
    }

    public function logout() {

        auth()->logout();
        return redirect()->route('login');

    }
}