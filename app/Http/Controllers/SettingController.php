<?php

namespace App\Http\Controllers;

use App\Setting;
use App\User;
use App\Promo;
use App\Slide;
use App\Traits\Upload;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    use Upload;
    
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

    public function slider()
    {
        $slide = \DB::select("SELECT id, name, IFNULL(NULL, 'promo') type
        FROM promos WHERE deleted_at IS NULL
        UNION
        SELECT id, name, IFNULL(NULL, 'news') type
        FROM news WHERE deleted_at IS NULL
        UNION
        SELECT id, name, IFNULL(NULL, 'lelang') type
        FROM lelangs WHERE deleted_at IS NULL
        UNION
        SELECT id, name, IFNULL(NULL, 'layanan') type
        FROM layanans WHERE deleted_at IS NULL
        UNION
        SELECT id, name, IFNULL(NULL, 'commodity') type
        FROM commodities WHERE deleted_at IS NULL
        UNION
        SELECT id, name, IFNULL(NULL, 'product') type
        FROM products WHERE deleted_at IS NULL");
        $images = Slide::get();
        return view('settings.slide', compact('slide', 'images'));
    }

    public function storeSlide(Request $request)
    {
        $request->validate([
            'path_image' => 'required',
            'slide_id' => 'required',
        ]);
        $request = $this->saveFile($request);
        Slide::create($request->all());
        return redirect()->route('slide.index')->withSuccess('Upload Gambar Slide Berhasil');
    }

    public function activeSlide(Request $request)
    {
        // 
    }

    public function orderSlide(Request $request)
    {
        // 
    }

    public function deleteSlide($id)
    {
        // 
    }
}
