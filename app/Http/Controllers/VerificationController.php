<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    //
    public function verify(Request $request)
    {
        $token = $request->token;

        // Cari pengguna dengan token yang diberikan
        $user = User::where('verification_token', $token)->first(); // masih salah

        if (!$user) {
            // Token tidak valid atau tidak ditemukan
            return redirect('/gagal-verification')->with('error', 'Token verifikasi tidak valid.');
        }

        // Verifikasi pengguna
        $user->email_verified_at = now(); // menverified email
        $user->verification_token = null; // Opsional: hapus token setelah digunakan
        $user->save();

        return redirect('/berhasil-verification')->with('success', 'Alamat email Anda telah diverifikasi.');
    }
    public function berhasil()
    {
        return view('email.berhasil-verification');
    }

    public function gagal()
    {
        return view('email.gagal-verification');
    }

}
