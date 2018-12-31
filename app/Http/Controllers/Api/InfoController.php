<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\News;
use App\Promo;
use App\Product;
use App\Lelang;
use App\Layanan;
use App\Commodity;
use App\Contact;
use App\Corporate;
use App\Valas;
use App\Vacancy;
use App\Slide;
use App\Setting;

class InfoController extends Controller
{
    /**
     * Response api dashboard
     */
    public function dashboard()
    {
        $promo = Promo::whereStatus(true)->whereHighlight(true)->paginate(5)->makeHidden(['slug', 'path_image', 'icon_image', 'description', 'hightligh', 'status', 'order', 'created_at', 'updated_at', 'deleted_at']);
        $news = News::whereStatus(true)->whereHighlight(true)->paginate(5)->makeHidden(['slug', 'path_image', 'icon_image', 'description', 'hightligh', 'status', 'order', 'created_at', 'updated_at', 'deleted_at']);
        $slider = Slide::whereStatus(true)->get()->makeHidden(['path_image', 'description', 'hightligh', 'status', 'order', 'created_at', 'updated_at', 'deleted_at']);
        $data = [
            'kode' => 1,
            'pesan' => 'success',
            'promo' => $promo,
            'news' => $news,
            'slider' => $slider,
        ];
        return response()->json($data);
    }

    /**
     * Response all resource news
     */
    public function listNews()
    {
        $news = News::whereStatus(true)->orderBy('id', 'desc')->paginate(10);
        return json($news->makeHidden(['status', 'highlight', 'description', 'path_image', 'icon_image', 'created_at', 'updated_at', 'deleted_at']));
    }

    /**
     * Response detail news
     * @param $id
     */
    public function news($id)
    {
        $news = News::whereStatus(true)->find($id);
        if ($news) {
            return json($news);
        }
        return json([], 'error', 1);
    }

    /**
     * Response all resource layanan
     */
    public function listLayanan()
    {
        $layanan = Layanan::whereStatus(true)->orderBy('id', 'desc')->paginate(10);
        return json($layanan->makeHidden(['status', 'highlight', 'description', 'path_image', 'icon_image', 'created_at', 'updated_at', 'deleted_at']));
    }

    /**
     * Response detail layanan
     * @param $id
     */
    public function layanan($id)
    {
        $layanan = Layanan::whereStatus(true)->find($id);
        if ($layanan) {
            return json($layanan);
        }
        return json([], 'error', 1);
    }

    /**
     * Response all resource promo
     */
    public function listPromo()
    {
        $promo = Promo::whereStatus(true)->orderBy('id', 'desc')->paginate(10);
        return json($promo->makeHidden(['slug', 'description', 'path_image', 'icon_image', 'hightligh', 'status', 'order', 'created_at', 'updated_at', 'deleted_at']));
    }
    /**
     * Response detail promo
     * @param $id
     */
    public function promo($id)
    {
        $promo = Promo::whereStatus(true)->find($id);
        if ($promo) {
            return json($promo->makeHidden(['path_image', 'icon_image', 'created_at', 'updated_at', 'deleted_at']));
        }
        return json([], 'error', 1);
    }

    /**
     * Response all resource lelang
     */
    public function listLelang()
    {
        $lelang = Lelang::whereStatus(true)->orderBy('id', 'desc')->paginate(10);
        return json($lelang->makeHidden(['slug', 'icon_image', 'description', 'hightligh', 'status', 'order', 'created_at', 'updated_at', 'deleted_at']));
    }

    /**
     * Response detail lelang
     * @param $id
     */
    public function lelang($id)
    {
        $lelang = Lelang::whereStatus(true)->find($id);
        if ($lelang) {
            return json($lelang->makeHidden(['path_image', 'icon_image', 'created_at', 'updated_at', 'deleted_at']));
        }
        return json([], 'error', 1);
    }

    /**
     * Response detail valas
     */
    public function valas()
    {
        $valas = Valas::get();
        if ($valas) {
            $data = [
                'kode' => 1,
                'pesan' => 'success',
                'result' => $valas->makeHidden(['id', 'created_at', 'updated_at']),
                'updated_at' => $valas->sortByDesc('updated_at')->first()->updated_at->toDateTimeString(),
            ];
            return response()->json($data);
        }
        return json([], 'error', 1);
    }

    /**
     * Response detail commodity
     * @param $id
     */
    public function commodity()
    {
        $commodity = Commodity::get();
        if ($commodity) {
            $data = [
                'kode' => 1,
                'pesan' => 'success',
                'result' => $commodity->makeHidden(['id', 'created_at', 'updated_at']),
                'updated_at' => $commodity->sortByDesc('updated_at')->first()->updated_at->toDateTimeString(),
            ];
            return response()->json($data);
        }
        return json([], 'error', 1);
    }

    /**
     * Response all resource product
     */
    public function listProduct()
    {
        $dana = Product::whereStatus(true)->whereCategory('dana')->orderBy('id', 'desc')->get()->makeHidden(['slug', 'description', 'path_image', 'icon_image', 'hightligh', 'status', 'order', 'created_at', 'updated_at', 'deleted_at']);
        $kredit = Product::whereStatus(true)->whereCategory('kredit')->orderBy('id', 'desc')->get()->makeHidden(['slug', 'description', 'path_image', 'icon_image', 'hightligh', 'status', 'order', 'created_at', 'updated_at', 'deleted_at']);
        $data = [
            'kode' => 1,
            'pesan' => 'success',
            'dana' => $dana,
            'kredit' => $kredit,
        ];
        return response()->json($data);
    }

    /**
     * Response detail product
     * @param $id
     */
    public function product($id)
    {
        $product = Product::whereStatus(true)->find($id);
        if ($product) {
            return json($product->makeHidden(['created_at', 'updated_at', 'deleted_at']));
        }
        return json([], 'error', 1);
    }

    /**
     * Response all resource vacancy
     */
    public function listVacancy()
    {
        $vacancies = Vacancy::whereDoesntHave('careers', function ($query) {
            $query->where('user_id', '=', auth()->user()->id);
        })->where('expired', '>', now())->orderBy('id', 'desc')->get();
        return json($vacancies->makeHidden(['created_at', 'updated_at', 'deleted_at']));
    }

    /**
     * Response detail vacancy
     * @param $id
     */
    public function vacancy($id)
    {
        $vacancy = Vacancy::where('expired', '>', now())->find($id);
        if ($vacancy) {
            return json($vacancy->makeHidden(['created_at', 'updated_at', 'deleted_at']));
        }
        return json([], 'error', 1);
    }

    /**
     * Response Slider
     */
    public function slider()
    {
        $slider = Slide::whereStatus(true)->orderBy('order')->get();
        if ($slider) {
            return json($slider->makeHidden(['id', 'path_image', 'order', 'status', 'created_at', 'updated_at', 'deleted_at']));
        }
        return json([], 'error', 1);
    }

    public function about()
    {
        $sejarah = Setting::sejarah();
        $sejarah = [
            $sejarah->title => $sejarah->data,
        ];
        $visi = Setting::visi();
        $visi = [
            $visi->title => $visi->data,
        ];
        $misi = Setting::misi();
        $misi = [
            $misi->title => explode(';', trim(preg_replace('/\s\s+/', '', (substr($misi->data, -1) == ';' ? substr($misi->data, 0, -1) : $misi->data)))),
        ];
        return json(array_merge($sejarah, $visi, $misi));
    }

    public function contacts()
    {
        $cabang = Contact::wherePosisi('cabang')->get()->makeHidden('created_at', 'updated_at');
        $kas = Contact::wherePosisi('kas')->get()->makeHidden('created_at', 'updated_at');
        $pusat = Contact::wherePosisi('pusat')->get()->makeHidden('created_at', 'updated_at');
        $socials = (array) Setting::social();
        foreach ($socials as $key => $value) {
            $social[] = array_merge(['nama' => ucwords($key)], (array) $value);
        }
        return json(compact('cabang', 'kas', 'pusat', 'social'));
    }

    public function corporates()
    {
        $komisaris = Corporate::whereBagian('komisaris')->get();
        $direksi = Corporate::whereBagian('direksi')->get();
        return json(compact('komisaris', 'direksi'));
    }
}
