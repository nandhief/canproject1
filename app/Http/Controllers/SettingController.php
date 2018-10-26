<?php

namespace App\Http\Controllers;

use App\Setting;
use App\User;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function dashboard()
    {
        return view('index');
    }

    public function index()
    {
        $settings = Setting::get();
        return view('settings.index', compact('settings'));
    }

    public function activation($token)
    {
        if (!empty($token)) {
            $user = User::whereActivation($token)->first();
            if ($user) {
                $user->update(['status' => true]);
                return view('activation', compact('user'));
            }
        }
        return abort(404);
    }
}
