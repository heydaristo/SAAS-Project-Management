<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;
use App\Models\Subscription;
use Illuminate\Support\Facades\Password;
use App\Models\Plan;
use Carbon\Carbon;
use App\Models\PasswordResetToken;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;
use App\Models\User;



class UserController extends Controller
{
    public function login(){
        return view('authentication.login');
    } 

    public function login_proses(Request $request){
        $validator = Validator::make($request->all(), [
            'email_or_name' => ['required'],
            'password' => ['required'],
        ]);
    
        if ($validator->fails()) {
            return redirect()->route('login')
                        ->withErrors($validator)
                        ->withInput();
        }
    
        $credentials = $request->only('email_or_name', 'password');
    
        if (Auth::attempt(['email' => $credentials['email_or_name'], 'password' => $credentials['password']]) ||
            Auth::attempt(['fullname' => $credentials['email_or_name'], 'password' => $credentials['password']])) {
            $request->session()->regenerate();
            if(Auth::user()->id_role == 1){
                return redirect()->route('superadmin.dashboard');
            } else if(Auth::user()->id_role == 2){
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->route('workspace.dashboard');
            }
        } else {
            return redirect()->route('login')->with('failed','Email atau Password Salah');
        }
    }
    
    public function forgotPasswordShow() {
        return view('authentication.forgot-password');
    }
    
    public function forgotPassword(Request $request) {
    $request->validate(['email' => 'required|email']);

    // Cek apakah pengguna adalah superadmin atau admin
    $user = User::where('email', $request->email)->first();
    if ($user && in_array($user->id_role, [1, 2])) {
        return back()->withErrors(['email' => 'Email not found']);
    }

    // Cek apakah ada token yang berlaku dalam satu jam terakhir
    $lastHour = Carbon::now()->subHour();
    $existingToken = PasswordResetToken::where('email', $request->email)
                                        ->where('created_at', '>=', $lastHour)
                                        ->first();

    if ($existingToken) {
        return back()->withErrors(['email' => 'Password reset link has been sent recently. Please try again later.']);
    }

    // Generate new reset token
    $status = Password::sendResetLink(
        $request->only('email')
    );

    return $status === Password::RESET_LINK_SENT
                ? back()->with(['success' => __($status)])
                : back()->withErrors(['email' => __($status)]);
    }

    public function resetPassword(Request $request, $token) {
        return view('authentication.reset-password', ['token' => $token]);

    }
    
    public function resetPasswordProses(Request $request) {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6|different:password', // Memastikan password baru berbeda dengan password saat ini
            'confirmPassword' => 'required|same:password',
        ]);
        
        // Gunakan Password::reset untuk mengubah password
        $status = Password::reset(
            $request->only('email', 'password', 'token'),
            function ($user, $password) {
                // Reset password dan simpan
                $user->password = Hash::make($password);
                $user->save();
            }
        );
        
        // Periksa status reset
        if ($status === Password::PASSWORD_RESET) {
            return redirect()->route('login')->with('success', 'Password has been reset successfully');
        } else {
            return back()->withInput($request->only('email'))->withErrors(['email' => [__($status)]]);
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
            return redirect()->route('register')->withErrors($validator)->withInput();
        }

        $defaultProfilePath = 'defaultProfile.png';

        $data['id_role'] = 3;
        $data['fullname']   = $request->fullname;
        $data['email']      = $request->email;
        $data['password']   = Hash::make($request->password);
        $data['profession'] = "notset";
        $data['experience_level'] = 0;
        $data['organization'] = "notset";
        $data['photo_profile'] = $defaultProfilePath;
        

        if(!$data){
            dd('error');
        }else{
            $result = User::create($data);
            if($result){
                // make subscription and transaction
                $subscription = [
                    'id_user' => $result->id,
                    'id_plan' => 1,
                    'status' => 'ACTIVE',
                    'duration' => 12,
                    'start_date' => now(),
                    'end_date' => now()->addMonths(12),
                ];

                $resultSubscription = Subscription::create($subscription);
                // make transaction
                // tambah ke table transaction
                $transaction = [
                    'id_subscription' => $resultSubscription->id,
                    'id_user' => $result->id,
                    'amount' => 0,
                    'status' => 'PAID',
                    'date' => now(),
                ];

                DB::table('transaction_admins')->insert($transaction);
                return redirect()->route('login')->with('success','Register Success');
                Alert::success('Success Message', 'Register Success');
            }else{
                return redirect()->route('register')->with('failed','Register Failed');
                Alert::error('Failed Message', 'Register Failed');
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

    public function usersetting(){
        return view('workspace.settings');
    }

    public function uploadProfile(Request $request){
        $validator = Validator::make($request->all(), [
            'fullname' => ['required'],
            'email' => ['required', 'email:dns'],
            'profession' => ['required'],
            'experience_level' => ['required'],
            'organization' => ['required'],
        ]);


        if ($validator->fails()) {
            Alert::error('Failed Message', 'You have failed update profile.'.strval($validator->errors()));
            return redirect()->route('workspace.settings')
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


        Alert::success('Success Message', 'You have successfully update profile.');
        $user = User::find(Auth::user()->id);
        $user->update($data);
        return redirect()->route('workspace.settings');
    }

    public function uploadImage(Request $request)
    {
       // Validasi inputan jika diperlukan
       $request->validate([
        'photo_profile' => ['required', 'image', 'max:2048'], // Maksimum 2MB (2048 KB)
    ]);

    if ($request->hasFile('photo_profile')) {
        // Dapatkan foto profil sebelumnya
        $user = User::find(Auth::user()->id);
        $previousPhoto = $user->photo_profile;

        // Hapus foto profil sebelumnya jika bukan foto default dan ada
        if ($previousPhoto && $previousPhoto !== 'defaultProfile.png' && File::exists(public_path('photo-user/' . $previousPhoto))) {
            File::delete(public_path('photo-user/' . $previousPhoto));
        }

        // Unggah foto profil yang baru
        $file = $request->file('photo_profile');
        $filename =  auth()->id() . '_' . date('Y-m-d') . '_' . $file->getClientOriginalName();
        $file->move(public_path('photo-user'), $filename);

        // Simpan nama file foto profil yang baru ke dalam database
        $user->photo_profile = $filename;
        $user->save();

        // Tampilkan pesan sukses dan redirect
        Alert::success('Success Message', 'You have successfully updated the photo profile.');
        return redirect()->route('workspace.settings', ['#tabs-activity-7']);
    }
}
    public function deleteProfile() {
        $user = User::find(Auth::user()->id);
         // Memeriksa apakah foto pengguna sudah menjadi default
        if ($user->photo_profile === 'defaultProfile.png') {
        Alert::error('Error Message', 'Cannot delete default profile picture.');
        return redirect()->route('workspace.settings', ['#tabs-activity-7'])->with('error', 'Cannot delete default profile picture.');
        }
        if($user->photo_profile) {
            File::delete(public_path('photo-user/'.$user->photo_profile));
        }
         // Mengatur foto profil menjadi default
        $defaultProfilePath = 'defaultProfile.png'; // Ganti dengan path default profile Anda
        $user->photo_profile = basename($defaultProfilePath); // Menggunakan nama file default
        $user->save();
        Alert::success('Success Message', 'You have successfully delete photo profile.');
        return redirect()->route('workspace.settings', ['#tabs-activity-7']);
    }

    public function changePasswordShow() {
        return view('workspace.changepassword');
    }

    public function changePassword(Request $request){
        $validator = Validator::make($request->all(), [
            'oldPassword' => ['required'],
            'newPassword' => ['required', 'min:6'],
            'confirmPassword' => ['required', 'same:newPassword'],
        ]);

        if ($validator->fails()) {
            Alert::error('Failed Message', 'You have failed change password.'.strval($validator->errors()));
            return redirect()->route('workspace.settings.changepassword')
                        ->withErrors($validator)
                        ->withInput();
        }

        $user = User::find(Auth::user()->id);
        if(Hash::check($request->oldPassword, $user->password)){
            $user->password = Hash::make($request->newPassword);
            $user->save();
            Alert::success('Success Message', 'You have successfully change password.');
            return redirect()->route('workspace.settings.changepassword');
        }else{
            Alert::error('Failed Message', 'You have failed change password.');
            return redirect()->route('workspace.settings.changepassword');
        }
    }

}