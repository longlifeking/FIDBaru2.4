<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class profilecontroller extends Controller
{
    //
    public function index ()
    {
        return view('profile');

    }
    public function edit()
    {
        $Profileall = User::where('username', Auth::user()->username)->firstOrFail();
        return view('profile1', ['Profileall' => $Profileall]);
    }
    public function updateakun(Request $request, $slug)
    {
        $validated = $request->validate
        ([
            'username' => 'required|unique:users,username,'.$slug.',slug',
            'phonenumber' => 'required|numeric',
            'address' => 'max:255',
            'email' => 'required|email|unique:users,email,'.$slug.',slug','|regex:/^([a-zA-Z0-9_.+-]+@pertamina\.com)$/',
            //'status' => 'max:255',
        ]);
            $validated['slug'] = Str::slug($request->username);
            $Profileall = User::where('slug', $slug)->firstOrFail();
            $Profileall->username = $validated['username'];
            $Profileall->phonenumber = $validated['phonenumber'];
            $Profileall->address = $validated['address'];
            $Profileall->email = $validated['email'];
            //$Profileall->status = $validated['status'];
            $Profileall->slug = $validated['slug'];
            $Profileall->save();   
            // Redirect to the appropriate page or return a response
            return redirect('profile1')->with('status','Berhasil');
    }
    public function update_password($slug)
    {
        $Profileall = User::where('slug', $slug)->firstOrFail();
        return view('update-password',['Profileall'=>$Profileall]);
    }
    public function ubahpassword(Request $request, $slug)
    {
        // Validasi input form
        $request->validate([
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password',
        ]);

        // Mengambil data pengguna berdasarkan slug
        $user = User::where('slug', $slug)->first();

        // Mengubah password pengguna
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->back()->with('success', 'Password berhasil diperbarui.');

    }


}
