<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index(){
        // get role id 1 or 2
        $admins = User::where('id_role', 1)->orWhere('id_role', 2)->get();
        return view('superadmin.user.index', compact('admins'));
    }

    public function store(Request $request){
        // store data
        $validator = Validator::make($request->all(), [
            'fullname' => ['required'],
            'email' => ['required', 'email:dns', 'unique:users,email'],
        ]);

        if ($validator->fails()) {
            return redirect()->route('superadmin.admin.show')
                        ->withErrors($validator)
                        ->withInput();
        }



        $data['id_role'] = 2;
        $data['fullname']   = $request->fullname;
        $data['email']      = $request->email;
        $data['password']   = Hash::make('12345');
        $data['profession'] = "Admin";
        $data['experience_level'] = 1;
        $data['organization'] = "Admin";
        $data['photo_profile'] = "https://png.pngtree.com/png-vector/20220628/ourmid/pngtree-user-profile-avatar-vector-admin-png-image_5289693.png";
        

        if(!$data){
            dd('error');
        }else{
            $result = User::create($data);
            if($result){
                Alert::success('Success Message', 'You have successfully add new admin.');
                return redirect()->route('superadmin.admin.show')->with('success','Berhasil menambahkan Admin!');
            }else{
                Alert::error('Failed Message', 'You have failed add new admin.');
                return redirect()->route('superadmin.admin.show')->with('failed','Gagal menambahkan Admin!');
            }
            
        }
    }
}
