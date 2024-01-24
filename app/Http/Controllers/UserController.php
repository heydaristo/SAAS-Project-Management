<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    public function login(){
        return view('authentication.login');
    } 

    public function login_proses(Request $request){
       $request->validate([
        'email' => 'required',
        'password' => 'required'
       ]);
    

        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if(Auth::attempt($data)){
            return redirect()->route('workspace.dashboard');
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
            'fullname'  => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password'
        ]);

        $data['fullname']   = $request->fullname;
        $data['email']      = $request->email;
        $data['password']   = Hash::make($request->password);
        $data['profession'] = "notset";
        $data['experience_level'] = 0;
        $data['organization'] = "notset";
        $data['photo_profile'] = "notset";
        
        if(!$data){
            dd('error');
        }else{
            User::create($data);

            $login = [
                'email'     => $request->email,
                'password'  => $request->password
            ];

            if (Auth::attempt($login)) {
                return redirect()->route('workspace.dashboard');
            } else {
                return redirect()->route('login')->with('failed', 'Email atau Password Salah');
            }
        }
    }


}
