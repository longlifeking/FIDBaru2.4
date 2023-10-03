<?php

namespace App\Http\Controllers;

use view;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\VerificationEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login()
    {
        return view('login');
    }
    public function register()
    {
        return view('register');
    }
    public function authenticating(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);
        if (Auth::attempt($credentials)) {
            if (Auth::user()->email_verified_at === null) { // jika email_verified_at null maka
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                Session::flash('status', 'failed');
                Session::flash('message', 'Email Anda belum diverifikasi');
                return redirect('/login');
            }

            if(Auth::User()->status_id != '2'){
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                Session::flash('status','failed');
                Session::flash('message','Tunggu Admin');
                return redirect('/login');
            }
            
            $request->session()->regenerate();
            if(Auth::User()->role_id == 1){
                return redirect('dashboard');
            }
            if(Auth::User()->role_id == 2){
                return redirect('dashboard2');
            }   
            if(Auth::User()->role_id == 3){
                return redirect('dashboard3');
            }
        }
        Session::flash('status','failed');
        Session::flash('message','login belum valid');
        return redirect('/login');
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('login');
    }
    public function registerProcess(Request $request){
        try{
            $validated = $request->validate([
                'username' => 'required|unique:users|max:255',
                'password' => 'required|min:8',
                'email' => 'required|email|unique:users|regex:/^([a-zA-Z0-9_.+-]+@pertamina\.com)$/',
                'phonenumber' => 'required|unique:users|numeric|digits_between:12,15',
                'address'=>'max:255',
            ], 
                ['email.regex' => 'Alamat email harus diakhiri dengan @pertamina.com',]);
        
                $validated['password'] = Hash::make($request->password);
                $validated['slug'] = Str::slug($request->username); // buat slug dari username
        
            //dd($request->password);
            $user = User::create($validated); // gunakan data yang telah divalidasi dan dimodifikasi
            
            $token = Str::random(60); // Anda perlu menghasilkan token ini
            $user->verification_token = $token; // Simpan token ke database
            $user->save();
            Mail::to($user->email)->send(new VerificationEmail($token));
            
            Session::flash('status','success');
            Session::flash('message','Anda berhasil Registrasi tapi stelah ini menunggu admin');
            return redirect('register');

        } catch (\Illuminate\Validation\ValidationException $e) {
            $errors = $e->validator->errors()->all();
            $errorMessage = implode('<br>', $errors);
            Session::flash('status','error');
            Session::flash('message', $errorMessage);
        }
        return redirect('register');
        
    }
    
    
}
