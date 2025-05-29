<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function indexlogin()
    {
        return view('auth.login');
    }

    public function postLogin(Request $request)
    {
        $request->validate([
            "username" => 'required',
            "password" => 'required',
            "role" => 'required',
        ]);

        $username = $request->username;
        $password = $request->password;
        $role = $request->role;

        if ($role == 'guru') {
            $credentials = [
                'kode_guru' => $username,
                'password' => $password
            ];
            $cekUser = User::where('kode_guru', $username)
                ->orWhere('email', $username)
                ->first();
            $roleCheck = $cekUser->role;
            
            if ($roleCheck != 'Guru' && $roleCheck != 'Staff') {
                return back()->with('loginError', 'Role tidak valid !');
            }

        } 
        if ($role == 'admin') {
            $credentials = [
                'email' => $username,
                'password' => $password
            ];
            $cekUser = User::where('kode_guru', $username)
                ->orWhere('email', $username)
                ->first();
            $roleCheck = $cekUser->role;
      
            if ($roleCheck != 'Admin') {
                return back()->with('loginError', 'Role tidak valid !');
            }
        } 
   
        if ($cekUser->status == '1') {
            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
                if($roleCheck == 'Guru' || $roleCheck =='Staff'){
                    return redirect()->intended('/presensi/dashboard');    
                }
                else{
                    return redirect()->intended('/');
                }
            }
        } else {
            return back()->with('loginError', 'Akun anda tidak aktif');
        }


        return back()->with('loginError', 'username atau password salah !');
        // dd($request->all());
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
