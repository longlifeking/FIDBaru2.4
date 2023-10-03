<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class Penggunacontroller extends Controller
{
    //
    public function Pengguna()
    {
        $Penggunaall = User::whereIn('role_id', [2, 3])->get();
        return view('Pengguna',['Penggunaall' => $Penggunaall]); 
    }
    public function edit($slug)
    {
        $Penggunaall = User::where('slug', $slug)->firstOrFail();
        return view('Pengguna-edit', ['Penggunaall' => $Penggunaall]);
    }
    public function update(Request $request, $slug)
    {
    // Validasi input
    $validated = $request->validate([
        'username' => 'required|unique:users,username,'.$slug.',slug',
        'phonenumber' => 'required|numeric',
        'address' => 'max:255',
        'status_id' => 'required',
        'email' => 'required|email|unique:users,email,'.$slug.',slug','|regex:/^([a-zA-Z0-9_.+-]+@pertamina\.com)$/',
        'role_id' => 'required',
    ]);
        $validated['slug'] = Str::slug($request->username);
        $Penggunaall = User::where('slug', $slug)->firstOrFail();
        $Penggunaall->username = $validated['username'];
        $Penggunaall->phonenumber = $validated['phonenumber'];
        $Penggunaall->address = $validated['address'];
        $Penggunaall->email = $validated['email'];
        $Penggunaall->status_id = $validated['status_id'];
        $Penggunaall->role_id = $validated['role_id'];
        $Penggunaall->slug = $validated['slug'];
        $Penggunaall->save();   
        // Redirect to the appropriate page or return a response
        return redirect('Pengguna')->with('status','Berhasil');
    }
    public function delete($slug){ //membuat notifikasi hapus
        $Penggunaall = User::where('slug', $slug)->firstOrFail();
        return view('Pengguna-Hapus',['Penggunaall'=>$Penggunaall]);
        //$fidtabel->delete();
        //return redirect('dashboard'); 
    }

    public function destroy($slug)
    { //membuat hapus akun
        $Penggunaall = User::where('slug', $slug)->firstOrFail();
        $Penggunaall->delete();
        return redirect('Pengguna');
    }
    public function update_password($slug)
    {
        $Penggunaall = User::where('slug', $slug)->firstOrFail();
        return view('user-password',['Penggunaall'=>$Penggunaall]);
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
