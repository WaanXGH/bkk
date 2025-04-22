<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login'); // Ganti dengan tampilan login Anda
    }
    #falidasi check buat login, apakah sudah masuk atau belum

    public function login_proses(Request $request)
    {
        // Validate whether email and password are filled in
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        // Check authentication
        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();

            if ($user->role === 'Admin') {
                return redirect()->route('admin.dashboard')->with('success', 'selamat datang admin!');
            } else {
                return redirect()->route('home')->with('success', 'selamat datang!');
            }
        } else {
            // Authentication failed
            return back()->withErrors([
                'email' => 'Email atau password salah',
            ]);
        }
    }


    // protected function halamanrole(Request $request, $user)
    // {
    //     if ($user->isAdmin()) {
    //         return redirect('/testadmin'); // Sesuaikan dengan rute admin
    //     }

    //     return redirect('/home'); // Sesuaikan dengan rute user
    // }


    #logout clear
    public function logout()
    {
        Auth::logout();
        Session::flush();
        Session::regenerateToken();


        return redirect()->route('login')->with('success', 'kamu berhasil logout');
    }

    public function register()
    {
        return view('auth.login');
    }

    public function register_proses(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => [
                'required',
                'min:6',
            ],
        ]);

        // dd($request->all());

        $data['nama'] = $request->nama_lengkap;
        $data['email'] = $request->email;
        $data['password'] = $this->encrypt_pass($request->password);

        $userCreated = new User();
        $userCreated->nama = $request->nama_lengkap;
        $userCreated->email = $request->email;
        $userCreated->password = $this->encrypt_pass($request->password);
        $userCreated->role = 'user';
        $userCreated->save();

        return redirect()->route('login')->with('message', 'Berhasil mendaftar!');


        // $request->validate([
        //     'email' => 'required',
        //     'password' => 'required',
        // ]);

        // $login = [
        //     'email' => $request->email,
        //     'password' => $request->password,
        // ];

        // #bakal return true or false logic   
        // if (Auth::attempt($login)) {
        //     return redirect()->route('home');
        // } else {
        //     return redirect()->route('login')->with('failed', 'E-mail atau password salah');
        // }

        // dd($data);
    }

    private function encrypt_pass($password)
    {
        return bcrypt($password);
    }
}
