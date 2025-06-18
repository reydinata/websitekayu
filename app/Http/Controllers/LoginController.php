<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\Pelanggan;
use App\Models\Admin;

class LoginController extends Controller
{
       public function index(){
        return view('login.index',[
            'title' => 'login',
            'active' => 'login'
        ]);
    }
    public function showregister(){
         return view('login.register');
    }
    public function register(Request $request){

    $validated = $request->validate([
        'nama_pelanggan' => 'required|string|max:255',
        'email_pelanggan' => 'required|email|unique:pelanggans,email_pelanggan',
        'telepon_pelanggan' => 'required|string|max:20',
        'password' => 'required|string|min:5',
    ]);

    $validated['password'] = bcrypt($validated['password']);

    \App\Models\Pelanggans::create($validated);

    return redirect('login')->with('success', 'Registrasi berhasil, silakan login.');
    }
public function autentikasi(Request $request)
{
    $credentials = $request->validate([
        'email' => 'required',
        'password' => 'required',
        'role' => 'required|in:pelanggans,admin',
    ]);

    $role = $credentials['role'];
    $guard = $role;

    $loginField = $role === 'admin' ? 'username' : 'email_pelanggan';

    $attemptCredentials = [
        $loginField => $credentials['email'],
        'password' => $credentials['password'],
    ];

    if (Auth::guard($guard)->attempt($attemptCredentials)) {
        $request->session()->regenerate();

        return response()->json([
            'success' => true,
            'redirect' => $role === 'admin' ? '/' : '/'
        ]);
    }

    return response()->json([
        'success' => false,
        'message' => 'Email atau password salah.'
    ]);
}


public function logout(Request $request){
     Auth::guard('pelanggans')->logout();
    Auth::guard('admin')->logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/');

}
}
