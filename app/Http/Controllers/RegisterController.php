<?php
// buat notifikasi bell 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notifications\bellnotifikasi;

class RegisterController extends Controller
{
    protected function registered(Request $request, $user)
    {
        if (!$request->user()->isAdmin()) { // jika ini bukan admin maka program akan menuju kebawah
            // Temukan admin dan kirim notifikasi
            $admin = User::where('role_id', Role::where('name', 'admin')->first()->id)->first(); // admin akan adalah dimana user yang memiliki role admin
            if ($admin) {
                $admin->notify(new bellnotifikasi($request->user())); // dia akan diberikan notifikasi  
            }
        }

    }
}
