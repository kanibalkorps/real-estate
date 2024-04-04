<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\ContactAdmin;
use App\Models\Log;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

//use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function register(){
        if (Auth::user()){
            return redirect()->back();
        }

        return view("pages.auth.register");
    }

    public function login(){
        if (Auth::user()){
            return redirect()->back();
        }

        return view("pages.auth.login");
    }

    public function loginUser(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {

            Log::info("User logged in.", Auth::user());
            if (Auth::user()->isAdmin()){
                return redirect()->route('admin.index');
            }

            return redirect()->route('home');
        }

        Log::error("User failed to login.", Auth::user());
        return redirect()->route('login')->with('error', 'Invalid credentials. Please try again.');
    }

    public function store(Request $request){

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $hashedPassword = Hash::make($request->input('password'));
        try {
            $user = User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => $hashedPassword,
                'role_id' => 1
            ]);

            Auth::login($user);
            Log::info("A new User has registered.", Auth::user());
            return redirect()->route("home");
        }
        catch (\Exception $e){
            Log::error("Error message: " . $e->getMessage(), Auth::user());
            return redirect()->back()->withInput();
        }
    }

    public function logout()
    {
        if (Auth::user()){
            Log::info("User logged out.", Auth::user());
            Auth::logout();
        }

        return redirect()->route("login");
    }

    public function sendEmail(Request $request){
        if (Auth::check()){
            $admin = "martin.birisic@gmail.com";
            $message = $request->message;

            Mail::to($admin)->send(new ContactAdmin($message));//queue($message);
        }

        return redirect()->route("home");
    }
}
