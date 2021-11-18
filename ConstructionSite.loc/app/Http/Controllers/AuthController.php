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
        if (Auth::check()) {
            return redirect('/');
        }

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
            return redirect()->intended('/');
        }

        return redirect("login")->withErrors('Login details are not valid');
    }


    public function registration()
    {
        if (Auth::check()) {
            return redirect('/');
        }

        return view('auth.registration');
    }

    public function customRegistration(Request $request)
    {
        $request->validate([
            'company_name' => 'required|unique:users',
            'company_cid' => ['required', 'unique:users', 'regex:/^[0-9]+$/', 'size:11'],
            'email' => 'required|email:rfc,dns|unique:users',
            'address' => 'required',
            'city' => 'required|regex:/^[a-žA-Ž ]+$/|',
            'password' => 'required|min:6|confirmed',
        ]);

        $data = $request->all();
        $this->create($data);

        return redirect("login")->with('success', 'You have been registered');
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

    public function update()
    {
        return view('auth.company-update');
    }

    public function customUpdate(Request $request)
    {
        $request->validate([
            'company_name' => 'required|unique:users,company_name,' . auth()->user()->id,
            'company_cid' => ['required', 'unique:users,company_cid,' . auth()->user()->id, 'regex:/^[0-9]+$/', 'size:11'],
            'email' => 'required|email:rfc,dns|unique:users,email,' . auth()->user()->id,
            'address' => 'required',
            'city' => 'required|regex:/^[a-žA-Ž ]+$/|',
        ]);

        $updatedUser = new User;

        $updatedUser->find(auth()->user()->id)->update(
            ['company_name' => $request->company_name,
                'company_cid' => $request->company_cid,
                'email' => $request->email,
                'address' => $request->address,
                'city' => $request->city,
            ]);

        return redirect("/");

    }

    public function passwordChange()
    {
        return view('auth.password-change');
    }

    public function passwordUpdate(Request $request)
    {
        $request->validate([
            'current_password' => 'required|min:6',
            'new_password' => 'required|min:6|confirmed',
        ]);

        if (Hash::check($request->current_password, auth()->user()->password)) {
            $updatedUser = new User;

            $updatedUser->find(auth()->user()->id)->update(
                ['password' => Hash::make($request->new_password),]);

            return redirect("/");

        } else {
            return redirect("password-change")->with('error', 'Current password is incorrect');
        }

    }

    public function signOut()
    {
        Session::flush();
        Auth::logout();

        return Redirect('login');
    }
}
