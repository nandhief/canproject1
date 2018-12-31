<?php

namespace App\Http\Controllers;

use App\Setting;
use App\User;
use App\Promo;
use App\Layanan;
use App\Lelang;
use App\News;
use App\Product;
use App\Slide;
use App\Tabungan;
use App\Credit;
use App\Commodity;
use App\Valas;
use App\Traits\Upload;
use App\Modul\Firebase;
use App\Modul\FirebasePush as Push;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    use Upload;
    
    public function dashboard()
    {
        $customers = User::has('customer')->get();
        $brokers = User::has('broker')->get();
        $tabungan = Tabungan::get();
        $credit = Credit::get();
        $slider = Slide::whereStatus(true)->orderBy('order')->get();
        $news = News::get();
        $promo = Promo::get();
        $lelang = Lelang::get();
        $commodity = Commodity::get();
        $valas = Valas::get();
        return view('index', compact('customers', 'brokers', 'slider', 'tabungan', 'credit', 'news', 'promo', 'lelang', 'commodity', 'valas'));
    }

    public function index()
    {
        $socials = Setting::social();
        $mails = Setting::mail();
        $androids = Setting::android();
        $sejarah = Setting::sejarah();
        $visi = Setting::visi();
        $misi = Setting::misi();
        $user = User::find(auth()->user()->id);
        return view('settings.index', compact('socials', 'mails', 'androids', 'sejarah', 'visi', 'misi', 'user'));
    }

    public function user(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'oldpassword' => 'required_with:newpassword',
        ]);
        $user = User::find(auth()->user()->id);
        if ($request->oldpassword) {
            if (password_verify($request->oldpassword, $user->password)) {
                $user->update(array_merge($request->all(), ['password' => $request->newpassword]));
            } else {
                return redirect()->back()->withInput($request->input())->withErrors('Mohon maaf password lama anda tidak sesuai dengan database, periksa kembali password anda');
            }
        } else {
            $user->update($request->all());
        }
        return redirect()->route('settings.index', 'edit=profile')->withSuccess('Update Pengguna ' . $user->name . ' berhasil diperbarui');
    }

    public function social(Request $request)
    {
        $data = [];
        $socials = Setting::whereTitle('social')->first();
        foreach ($request->social_id as $key => $value) {
            if ($request->social[$key] && $request->name[$key] && $request->url[$key]) {
                $filename = '';
                if (isset($request->icon[$key])) {
                    $filename = date('YmdHis_') . $request->icon[$key]->getClientOriginalName();
                    $request->icon[$key]->move('./storage/files', $filename);
                }
                $data[$request->social[$key]] = [
                    'name' => $request->name[$key],
                    'icon' => empty($filename) ? json_decode($socials->data)->{$request->social[$key]}->icon : asset('storage/files/'.$filename),
                    'url' => $request->url[$key],
                ];
            }
        }
        $socials->update([
            'data' => json_encode($data),
        ]);
        return redirect()->back()->withSuccess('Update Sosial Media berhasil diperbarui');
    }

    public function mail(Request $request)
    {
        $mail = Setting::mail();
        $mail->server->host = $request->server_host;
        $mail->server->email = $request->server_email;
        $mail->server->password = $request->server_password;
        $mail->kredit->host = $request->kredit_host;
        $mail->kredit->email = $request->kredit_email;
        $mail->kredit->password = $request->kredit_password;
        $mail->tabungan->host = $request->tabungan_host;
        $mail->tabungan->email = $request->tabungan_email;
        $mail->tabungan->password = $request->tabungan_password;
        $mail->career->host = $request->career_host;
        $mail->career->email = $request->career_email;
        $mail->career->password = $request->career_password;
        Setting::whereTitle('mail')->update([
            'data' => json_encode($mail),
        ]);
        return redirect()->route('settings.index')->withSuccess('Update Mail Server berhasil diperbarui');
    }

    public function android(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'token' => 'required',
        ]);
        $android = Setting::whereTitle('android')->first();
        $android->update([
            'data' => json_encode($request->except('_token')),
        ]);
        return redirect()->route('settings.index')->withSuccess('Update Android Push Notification berhasil diperbarui');
    }

    public function sejarah(Request $request)
    {
        $request->validate([
            'data' => 'required'
        ]);
        $sejarah = Setting::whereTitle('sejarah')->first();
        $sejarah->update($request->except('_token'));
        return redirect()->route('settings.index')->withSuccess('Update Sejarah berhasil diperbarui');
    }

    public function visi(Request $request)
    {
        $request->validate([
            'data' => 'required',
        ]);
        $visi = Setting::whereTitle('visi')->first();
        $visi->update($request->except('_token'));
        return redirect()->route('settings.index')->withSuccess('Update Visi berhasil diperbarui');
    }

    public function misi(Request $request)
    {
        $request->validate([
            'data' => 'required'
        ]);
        $misi = Setting::whereTitle('misi')->first();
        $misi->update($request->except('_token'));
        return redirect()->route('settings.index')->withSuccess('Update Misi berhasil diperbarui');
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
        $data = [];
        $slide = \DB::select("SELECT id, name, IFNULL(NULL, 'promo') type
        FROM promos WHERE status = 1 AND deleted_at IS NULL
        UNION
        SELECT id, name, IFNULL(NULL, 'news') type
        FROM news WHERE status = 1 AND deleted_at IS NULL
        UNION
        SELECT id, name, IFNULL(NULL, 'lelang') type
        FROM lelangs WHERE status = 1 AND deleted_at IS NULL
        UNION
        SELECT id, name, IFNULL(NULL, 'layanan') type
        FROM layanans WHERE status = 1 AND deleted_at IS NULL
        UNION
        SELECT id, name, IFNULL(NULL, 'product') type
        FROM products WHERE status = 1 AND deleted_at IS NULL");
        $images = Slide::orderBy('status', 'desc')->orderBy('order')->get();
        if (request()->ajax()) {
            foreach ($images as $key => $value) {
                $data[] = collect($value)->prepend($key+1, 'no');
            }
            return response()->json(compact('data'));
        }
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
        $slides = Slide::whereStatus(true)->get();
        if ($slides->count() > 5) {
            return response()->json(['errors' => 'Maksimal Slide yang aktif hanya 5'], 422);
        } else {
            $slide = Slide::find($request->id);
            $slide->update([
                'status' => $request->status,
            ]);
            return response()->json(['success' => 'Slide ' . $slide->name . ' berhasil di update']);
        }
    }

    public function orderSlide(Request $request)
    {
        foreach ($request->item as $key => $item) {
            Slide::find($item)->update([
                'order' => $key+1,
            ]);
        }
        return response()->json(['success' => 'Berhasil Update Order Slide']);
    }

    public function deleteSlide($id)
    {
        $slide = Slide::find($id);
        $slide->delete();
        return redirect()->route('slide.index')->withSuccess('Data Slide berhasil dihapus');
    }

    /**
     * Notification all customer
     * 
     */
    public function notifications(Request $request, Push $push, Firebase $firebase)
    {
        switch ($request->type) {
            case 'promo':
                $data = Promo::find($request->id);
                break;
            case 'lelang':
                $data = Lelang::find($request->id);
                break;
            case 'news':
                $data = News::find($request->id);
                break;
            case 'layanan':
                $data = Layanan::find($request->id);
                break;
            case 'product':
                $data = Product::find($request->id);
                break;
        }
        $data->update(['notif' => true]);
        $notification = [
            'body' => $data->name,
        ];
        $push->setTitle('BPR MAA MOBILE :: ' . strtoupper($request->type));
        $push->setMessage($data->name);
        $push->setImage(null);
        $push->setIsBackground(FALSE);
        $push->setPayload($request->type);
        foreach (User::whereHas('customer')->whereNotNull('fcm_token')->get() as $user) {
            $response[] = array_merge($push->getPush(), [
                'name' => $user->name, 
                'email' => $user->email,
                'notification' => $firebase->send(
                    $user->fcm_token,
                    $notification,
                    $push->getPush()
                )
            ]);
        }
        return response()->json(array_merge(compact('response'), ['success' => '[' . strtoupper($request->type) . ']' . $data->name . ' Berhasil diberitahukan kepada semua customer']));
    }
}
