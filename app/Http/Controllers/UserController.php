<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

use App\Models\User;



class UserController extends Controller
{
    public function login(){
        return view('authentication.login');
    } 

    public function login_proses(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => ['required'],
            'password' => ['required'],
            
        ]);

        if ($validator->fails()) {
            return redirect()->route('login')
                        ->withErrors($validator)
                        ->withInput();
        }

        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if(Auth::attempt($data)){
            $request->session()->regenerate();
            if(Auth::user()->id_role == 1){
                return redirect()->route('superadmin.dashboard');
            }else if(Auth::user()->id_role == 2){
                return redirect()->route('admin.dashboard');
            }
            else{
                return redirect()->route('workspace.dashboard');
            }
        }else{
            return redirect()->route('login')->with('failed','Email atau Password Salah');
        }

    }

    public function register(){
        return view('authentication.register');
    }

    public function register_proses(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fullname' => ['required'],
            'email' => ['required', 'email:dns', 'unique:users,email'],
            'password' => ['required', 'min:6'],
            'confirmPassword' => ['required', 'same:password'],
        ]);

        if ($validator->fails()) {
            return redirect()->route('register')
                        ->withErrors($validator)
                        ->withInput();
        }



        $data['id_role'] = 3;
        $data['fullname']   = $request->fullname;
        $data['email']      = $request->email;
        $data['password']   = Hash::make($request->password);
        $data['profession'] = "notset";
        $data['experience_level'] = 0;
        $data['organization'] = "notset";
        $data['photo_profile'] = "https://png.pngtree.com/png-vector/20220628/ourmid/pngtree-user-profile-avatar-vector-admin-png-image_5289693.png";
        

        if(!$data){
            dd('error');
        }else{
            $result = User::create($data);
            if($result){
                return redirect()->route('login')->with('success','Register Success');
            }else{
                return redirect()->route('register')->with('failed','Register Failed');
            }
            
        }
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }

    public function index(){
        $users = User::where('id_role', 3)->get();
        $users = User::paginate(10);

        return view('admin.user.index', compact('users'));
    }

    public function store(Request $request){

        // store data
        $validator = Validator::make($request->all(), [
            'fullname' => ['required'],
            'email' => ['required', 'email:dns', 'unique:users,email'],
        ]);

        if ($validator->fails()) {
            $error = "You have failed add new admin.\n".strval($validator->errors());
            Alert::error('Failed Message', $error);
            return redirect()->route('superadmin.admin.show')
                        ->withErrors($validator)
                        ->withInput();
        }

        $data['id_role'] = 3;
        $data['fullname']   = $request->fullname;
        $data['email']      = $request->email;
        $data['password']   = Hash::make('12345');
        $data['profession'] = "notset";
        $data['experience_level'] = 0;
        $data['organization'] = "notset";
        $data['photo_profile'] = "https://png.pngtree.com/png-vector/20220628/ourmid/pngtree-user-profile-avatar-vector-admin-png-image_5289693.png";
        

        if(!$data){
            dd('error');
        }else{
            $result = User::create($data);
            if($result){
                Alert::success('Success Message', 'You have successfully add new freelance.');
                return redirect()->route('admin.user.show');
            }else{
                Alert::error('Failed Message', 'You have failed add new freelance.');
                return redirect()->route('admin.user.show');
            }
            
        }
    }

    public function destroy(Request $request,$id){
        // delete data
        $user = User::find($id);

        $user->delete();
        Alert::success('Success Message', 'You have successfully delete user.');
        return redirect()->route('admin.user.show');
    }

    public function update(Request $request, $id){
        // update data
        $validator = null;
        if($request->password != null){
            $validator = Validator::make($request->all(), [
                'fullname' => ['required'],
                'email' => ['required', 'email:dns'],
                'password' => ['required', 'min:6'],
                'profession' => ['required'],
                'experience_level' => ['required'],
                'organization' => ['required'],
            ]);

            if($validator->fails()){
                return redirect()->route('admin.user.show')
                            ->withErrors($validator)
                            ->withInput();
            }

            $data = [
                'fullname' => $request->fullname,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'profession' => $request->profession,
                'experience_level' => $request->experience_level,
                'organization' => $request->organization,
            ];

            User::find($id)->update($data);
            Alert::success('Success Message', 'You have successfully update user.');
            return redirect()->route('admin.user.show');
        }else{
            $validator = Validator::make($request->all(), [
                'fullname' => ['required'],
                'email' => ['required', 'email:dns'],
                'profession' => ['required'],
                'experience_level' => ['required'],
                'organization' => ['required'],
            ]);

            if($validator->fails()){
                return redirect()->route('admin.user.show')
                            ->withErrors($validator)
                            ->withInput();
            }

            $data = [
                'fullname' => $request->fullname,
                'email' => $request->email,
                'profession' => $request->profession,
                'experience_level' => $request->experience_level,
                'organization' => $request->organization,
            ];

            User::find($id)->update($data);
            Alert::success('Success Message', 'You have successfully update admin.');
            return redirect()->route('admin.user.show');
        }    
    }
}