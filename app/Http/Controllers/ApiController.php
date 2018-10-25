<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use App\Mail\RegisterMail;
use App\Mail\ResetMail;
use App\News;
use App\Promo;
use App\Lelang;
use App\Customer;
use App\User;
use App\Career;

class ApiController extends Controller
{

    /**
     * Register user customer
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|max:191',
            'email' => 'required|email|max:191',
            'phone' => 'required|numeric',
            'password' => 'required|max:191',
        ]);
        if (User::whereEmail($request->email)->first()) return json('Email sudah pernah dipakai', 'error', 0);
        if (User::wherePhone($request->phone)->first()) return json('Nomer Phone sudah pernah dipakai', 'error', 0);
        $user = User::create(array_merge($request->all(), ['activation' => str_random(60)]));
        if ($user) {
            $user->customer()->create([]);
            \Mail::to($user->email, $user->name)->send(new RegisterMail($user));
            return json('Terima kasih sudah mendaftar, buka email anda untuk melakukan aktivasi akun');
        } else {
            return json('Terjadi kesalahan saat mendaftar', 'error', 'error', 0);
        }
    }

    /**
     * Login user customer
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|max:191',
            'password' => 'required|max:191',
        ]);
        $user = User::where('email', $request->username)->orWhere('phone', $request->username)->first();
        if ($user) {
            if (password_verify($request->password, $user->password)) {
                if ($user->status) {
                    $user->update(['api_token' => str_random(40)]);
                    return json($user->token);
                } else {
                    return json('Mohon maaf. akun anda belum di aktivasi, buka email registrasi anda untuk aktivasi', 'error', 0);
                }
            }
        }
        return json('Identitas tersebut tidak cocok dengan data kami.', 'error', 0);
    }

    /**
     * Reset password user 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function forgot(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);
        $user = User::whereEmail($request->email)->first();
        if ($user) {
            \Mail::to($user->email, $user->name)->send(new ResetMail($user, Password::broker()->createToken($user)));
            return json('Untuk reset password sudah kami kirimkan ke email ' . $request->email);
        }
        return json('Kami tidak dapat menemukan email ' . $request->email . ' didata kami, pastikan anda sudah pernah mendaftar', 'error', 0);
    }
}
