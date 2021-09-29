<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $username = $request->username;
        $password = $request->password;

        $content = DB::table('users')->where('username', $username)->first();
        if (!$content) {
            Alert::error('Error', 'Username anda salah');
            return redirect('/login');
        }

        if ($content->password == $password) {
            $sess = $request->session()->put([
                'id_guest' => $content->id,
                'nama' => $content->name,
                'email' => $content->email,
                'username' => $content->username,
                'is_login' => true
            ]);
            Alert::success('Success', $content->name . 'Otentikasi Berhasil');
            return redirect('/')->with(['sess' => $sess]);
        } else {
            Alert::error('Error', 'Password salah');
            return redirect('/login');
        }
    }

    public function logout(Request $request)
    {
        $request->session()->forget('is_login');
        return redirect('/login');
    }
}
