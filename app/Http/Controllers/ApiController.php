<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use App\Mail\RegisterMail;
use App\Mail\ResetMail;
use App\User;
use App\Career;
use App\Credit;
use App\Tabungan;
use App\Customer;
use App\History;

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
            return json('Terjadi kesalahan saat mendaftar', 'error', 0);
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
        $user = User::with(['customer'])->where('email', $request->username)->orWhere('phone', $request->username)->first();
        if ($user) {
            if (password_verify($request->password, $user->password)) {
                if ($user->status) {
                    $user->update(['api_token' => str_random(40)]);
                    return json(collect($user->makeHidden(['id', 'admin', 'activation', 'created_at', 'updated_at', 'deleted_at', 'path_foto']))->prepend($user->token, 'token')->prepend($user->customer->id, 'customer_id'));
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

    /**
     * Apply for career
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function career(Request $request)
    {
        $request->validate([
            'name' => 'required|max:191',
            'email' => 'required|max:191',
            'phone' => 'required|numeric',
            'posisi' => 'required|max:191',
            'description' => 'required',
        ]);
        if ($request->hasFile('path_resume')) {
            $filename = date('YmdHis_') . $request->path_resume->getClientOriginalName();
            $request->path_resume->move('./storage/original', $filename);
            $request = new Request(array_merge($request->all(), ['path_resume' => $filename]));
        }
        $career = Career::create($request->all());
        return json('Terima Kasih lamarannya, mohon tunggu kabar baik dari kami');
    }

    /**
     * Validate credit dan tabungan
     * @param  \Illuminate\Http\Request  $request
     */
    public function validateCreditTabungan($request)
    {
        $request->validate([
            'foto_ktp' => 'required',
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required|numeric',
            'email' => 'required|email',
        ]);
        if ($request->hasFile('foto_ktp')) {
            $filename = date('YmdHis_') . $request->foto_ktp->getClientOriginalName();
            $request->foto_ktp->move('./storage/original', $filename);
        }
    }
    
    /**
     * Request create credit
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function credit(Request $request)
    {
        $this->validateCreditTabungan($request);
        $customer = Customer::find(auth()->user()->customer->id);
        $customer->update([$request->only('foto_ktp')]);
        $history = new History(['description' => 'Pengajuan Kredit']);
        if ($customer->credit) {
            switch ($customer->credit->status) {
                case null:
                    return json('Mohon maaf anda sudah melakukan pengajuan kredit, mohon untuk di proses dari kami', 'error', 0);
                    break;
                case 0:
                    return json('Mohon maaf anda sudah melakukan pengajuan kredit dan sedang dalam tahap proses dari kami, mohon tunggu kabar baik dari kami', 'error', 0);
                    break;
            }
        }
        $credit = $customer->credit()->create([]);
        $credit->histories()->save($history);
        return json('Terima kasih sudah mengajukan Kredit, untuk informasi selanjutnya akan kami info di email/telephone/sms');
    }
    
    /**
     * Request create tabungan
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function tabungan(Request $request)
    {
        $this->validateCareerTabungan($request);
        $customer = Customer::find(auth()->user()->customer->id);
        $history = new History(['description' => 'Pengajuan Tabungan']);
        if ($customer->tabungan) {
            switch ($customer->tabungan->status) {
                case null:
                    return json('Mohon maaf anda sudah melakukan pengajuan tabungan, mohon tunggu untuk di proses kami', 'error', 0);
                    break;
                case 0:
                    return json('Mohon maaf anda sudah melakukan pengajuan tabungan dan sedang dalam tahap proses dari kami, mohon tunggu kabar baik dari kami', 'error', 0);
                    break;
            }
        }
        $tabungan = $customer->tabungan()->create([]);
        $tabungan->histories()->save($history);
        return json('Terima kasih sudah mengajukan Tabungan, untuk informasi selanjutnya akan kami info di email/telephone/sms');
    }
}
