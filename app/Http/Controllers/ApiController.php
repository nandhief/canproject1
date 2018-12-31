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
use App\Vacancy;
use App\Setting;

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
            'password' => 'required|max:191|min:6',
        ], [
            'name.required' => 'Nama tidak boleh kosong',
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Format Email harus benar',
            'phone.required' => 'No ponsel tidak boleh kosong',
            'phone.numeric' => 'No ponsel harus berupa angka',
            'password.required' => 'Password tidak boleh kosong',
            'password.min' => 'Password minimal harus 6 karakter',
        ]);
        if (User::whereEmail($request->email)->first()) return json('Email sudah pernah dipakai', 'error', 0);
        if (User::wherePhone($request->phone)->first()) return json('Nomer Phone sudah pernah dipakai', 'error', 0);
        $user = User::create(array_merge($request->all(), ['activation' => str_random(60)]));
        if ($user) {
            $user->customer()->create([]);
            \Mail::to($user->email, $user->name)->send(new RegisterMail($user));
            $user->update(['api_token' => str_random(40), 'fcm_token' => $request->fcm_token]);
            return json(collect($user->makeHidden(['id', 'admin', 'activation', 'created_at', 'updated_at', 'deleted_at', 'path_foto']))->prepend($user->token, 'token')->prepend($user->customer->id, 'customer_id')->prepend('Terima kasih sudah mendaftar, silakan buka email anda untuk melakukan aktivasi akun', 'message'));
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
            'fcm_token' => 'required|max:191',
        ]);
        $user = User::with(['customer'])->where('email', $request->username)->orWhere('phone', $request->username)->first();
        if ($user) {
            if (password_verify($request->password, $user->password)) {
                if ($user->status) {
                    $user->update(['api_token' => str_random(40), 'fcm_token' => $request->fcm_token]);
                    return json(collect($user->makeHidden(['id', 'admin', 'activation', 'created_at', 'updated_at', 'deleted_at', 'path_foto']))->prepend($user->token, 'token')->prepend($user->customer->id, 'customer_id'));
                } else {
                    return json('Mohon maaf. akun anda belum di aktivasi, buka email registrasi anda untuk aktivasi', 'error', 0);
                }
            }
        }
        return json('Maaf email atau password salah', 'error', 0);
    }

    public function login_otp(Request $request)
    {
        $request->validate([
            'phone' => 'required',
            'fcm_token' => 'required',
        ], [
            'phone.required' => 'No ponsel tidak boleh kosong',
            'fcm_token.required' => 'FCM Token tidak boleh kosong',
        ]);
        $user = User::with(['customer'])->where('phone', $request->phone)->first();
        if ($user) {
            $user->update(['api_token' => str_random(40), 'fcm_token' => $request->fcm_token]);
            return json(collect($user->makeHidden(['id', 'admin', 'activation', 'created_at', 'updated_at', 'deleted_at', 'path_foto']))->prepend($user->token, 'token')->prepend($user->customer->id, 'customer_id'));
        }
        return json('Nomor salah', 'error', 0);
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
     * Update User
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update_user(Request $request)
    {
        $request->validate([
            'email' => 'required|unique:users,email,'. auth()->user()->id,
        ]);
        if ($request->hasFile('path_foto')) {
            $filename = date('YmdHis_') . $request->path_foto->getClientOriginalName();
            $request->path_foto->move('./storage/original', $filename);
            $request = new Request(array_merge($request->all(), ['path_foto' => $filename]));
        }
        $user = User::whereEmail(auth()->user()->email)->first();
        $user->update($request->all());
        $user->customer->update($request->all());
        return json(collect($user)->prepend('Update user ' . $user->name . ' Berhasil', 'message'));
    }

    public function password_user(Request $request)
    {
        $request->validate([
            'password' => 'required|min:6',
        ]);
        $user = User::whereEmail(auth()->user()->email)->first();
        $user->update($request->except('email'));
        return json(collect($user)->prepend('Update password user ' . $user->name . ' Berhasil', 'message'));
    }

    /**
     * Apply for career
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function career(Request $request)
    {
        $request->validate([
            'vacancy_id' => 'required',
            'name' => 'required|max:191',
            'email' => 'required|max:191',
            'phone' => 'required|numeric',
            'description' => 'required',
        ]);
        $user = auth()->user();
        $vacancy = Vacancy::find($request->vacancy_id);
        if ($vacancy->careers()->whereUserId($user->id)->whereStatus(0)->first()) {
            return json('Mohon maaf anda sudah melamar, tunggu kabar dari kami', 'error', 0);
        }
        if ($request->hasFile('path_resume')) {
            $filename = date('YmdHis_') . $request->path_resume->getClientOriginalName();
            $request->path_resume->move('./storage/original', $filename);
            $request = new Request(array_merge($request->all(), ['path_resume' => $filename]));
        }
        \Mail::raw('Permeritahuan: ' . $request->name . '(' . $request->email . ') sedang melamar pekerjaan: ' . $vacancy->name, function ($message) {
            $message->from(Setting::mail()->server->email, 'BPR MAA Mobile Backend');
            $message->to(Setting::mail()->career->email);
            $message->subject('Karir BPR MAA Mobile Apps');
        });
        $vacancy->careers()->create(array_merge($request->all(), ['user_id' => $user->id]));
        return json('Terima Kasih, lamaran anda berhasil dikirim');
    }

    /**
     * Validate credit dan tabungan
     * @param  \Illuminate\Http\Request  $request
     */
    public function validateCreditTabungan($request)
    {
        $request->validate([
            'foto_ktp' => 'required|image',
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required|numeric',
            'email' => 'required|email',
        ], [
            'foto_ktp.required' =>  'Foto KTP Tidak boleh kosong',
            'foto_ktp.image' =>  'Foto KTP Harus gambar',
            'name.required' =>  'Nama Tidak boleh kosong',
            'alamat.required' =>  'Alamat Tidak boleh kosong',
            'phone.required' =>  'No Ponsel Tidak boleh kosong',
            'phone.numeric' =>  'No Ponsel Hanya angka',
            'email.required' =>  'Email Tidak boleh kosong',
            'email.email' =>  'Email harus benar',
        ]);
        if ($request->hasFile('foto_ktp')) {
            if (substr($request->phone, 0, 2) == '08') {
                $phone = '+62' . substr($request->phone, 1);
            } else {
                $phone = $request->phone;
            }
            $filename = date('YmdHis_') . $request->foto_ktp->getClientOriginalName();
            $request->foto_ktp->move('./storage/original', $filename);
            $request = new Request(array_merge($request->all(), ['foto_ktp' => $filename, 'alamat' => $request->address, 'phone' => $phone]));
        }
        return $request;
    }
    
    /**
     * Request create credit
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function credit(Request $request)
    {
        $request = $this->validateCreditTabungan($request);
        $customer = Customer::find(auth()->user()->customer->id);
        $customer->update($request->only('foto_ktp', 'alamat'));
        $customer->user()->update($request->except('foto_ktp', 'alamat'));
        if ($customer->credit) {
            return json('Maaf, Anda sudah melakukan pengajuan kredit. Mohon tunggu proses dari tim Kami', 'error', 0);
        }
        \Mail::raw('Permeritahuan: ' . $request->name . '(' . $request->email . ') sedang mengajukan Kredit', function ($message) {
            $message->from(Setting::mail()->server->email, 'BPR MAA Mobile Backend');
            $message->to(Setting::mail()->kredit->email);
            $message->subject('Pengajuan Kredit BPR MAA Mobile Apps');
        });
        $history = new History(['description' => 'Pengajuan Kredit']);
        $credit = $customer->credit()->create([]);
        $credit->histories()->save($history);
        return json([], 'Terima kasih pengajuan kredit anda akan kami proses.');
    }
    
    /**
     * Request create tabungan
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function tabungan(Request $request)
    {
        $request = $this->validateCreditTabungan($request);
        $customer = Customer::find(auth()->user()->customer->id);
        $customer->update($request->only('foto_ktp'));
        $customer->user()->update($request->except('foto_ktp'));
        if ($customer->tabungan) {
            return json('Maaf, Anda sudah melakukan pengajuan tabungan. Mohon tunggu proses dari tim Kami', 'error', 0);
        }
        \Mail::raw('Permeritahuan: ' . $request->name . '(' . $request->email . ') sedang mengajukan Tabungan', function ($message) {
            $message->from(Setting::mail()->server->email, 'BPR MAA Mobile Backend');
            $message->to(Setting::mail()->kredit->email);
            $message->subject('Pengajuan Tabungan BPR MAA Mobile Apps');
        });
        $history = new History(['description' => 'Pengajuan Tabungan']);
        $tabungan = $customer->tabungan()->create([]);
        $tabungan->histories()->save($history);
        return json([], 'Terima kasih pengajuan tabungan anda akan kami proses.');
    }

    public function history($history)
    {
        $histories = [];
        $user = User::find(auth()->user()->id);
        if ($history == 'tabungan') {
            $tabungan = Tabungan::whereCustomerId($user->customer->id)->first();
            if ($tabungan) {
                $histories = $tabungan->histories->makeHidden(['id', 'reply', 'created_at', 'updated_at']);
            }
            return json($histories);
        }
        if ($history == 'credit') {
            $credit = Credit::whereCustomerId($user->customer->id)->first();
            if ($credit) {
                $histories = $credit->histories->makeHidden(['id', 'reply', 'created_at', 'updated_at']);
            }
            return json($histories);
        }
    }
}
