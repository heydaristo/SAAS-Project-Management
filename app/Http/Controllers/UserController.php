<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function login(){
        return view('authentication.login');
    } 

    public function login_proses(Request $request){
       $request->validate([
        'email' => 'required|email:dns',
        'password' => 'required'
       ]);
    

        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if(Auth::attempt($data)){
            return redirect()->route('workspace.dashboard');
            $request->session()->regenerate();
        }else{
            return redirect()->route('login')->with('failed','Email atau Password Salah');
        }

    }

    public function register(){
        return view('authentication.register');
    }

    public function register_proses(Request $request)
    {
        $request->validate([
            'fullname'  => 'required|regex:/^[A-Z][a-z]*$/',
            'email' => 'required|email|unique:users,email,dns',
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password'
        ], [
            'fullname.regex' => 'Name must start with a capital letter',
            'password.min' => 'Password must be at least 8 characters long',
            'confirmPassword.same' => 'Passwords do not match',
        ]);

       

        // $data['fullname']   = $request->fullname;
        // $data['email']      = $request->email;
        // $data['password']   = Hash::make($request->password);
        // $data['profession'] = null;
        // $data['experience_level'] = null;
        // $data['organization'] = null;
        // $data['photo_profile'] = null;
        
        // if(!$data){
        //     dd('error');
        // }else{
        //     User::create($data);

        //     $login = [
        //         'email'     => $request->email,
        //         'password'  => $request->password
        //     ];

        //     if (Auth::attempt($login)) {
        //         return redirect()->route('workspace.dashboard');
        //     } else {
        //         return redirect()->route('login')->with('failed', 'Email atau Password Salah');
        //     }
        // }

    }


}
