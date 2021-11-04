<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Session;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }


    public function customLogin(Request $request)
    {
        $request->validate([
            'company_name' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('company_name', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('');
        }

        return redirect("login")->withErrors('Login details are not valid');
    }



    public function registration()
    {
        return view('auth.registration');
    }


    public function customRegistration(Request $request)
    {
        $request->validate([
            'company_name' => 'required|unique:users',
            'company_cid' => ['required','unique:users', 'regex:/^[0-9]+$/', 'size:11'],
            'email' => 'required|email:rfc,dns|unique:users',
            'address' => 'required',
            'city' => 'required|regex:/^[a-žA-Ž]+$/|',
            'password' => 'required|min:6|confirmed',
        ]);

        $data = $request->all();
        $check = $this->create($data);

        return redirect("login")->with('success','You have been registered');
    }


    public function create(array $data)
    {
        return User::create([
            'company_name' => $data['company_name'],
            'company_cid' => $data['company_cid'],
            'address' => $data['address'],
            'city' => $data['city'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);
    }


    public function dashboard()
    {
        if(Auth::check()){
            return view('/');
        }

        return redirect("login")->with('errors','You are not allowed to access');
    }


    public function signOut() {
        Session::flush();
        Auth::logout();

        return Redirect('login');
    }
}
