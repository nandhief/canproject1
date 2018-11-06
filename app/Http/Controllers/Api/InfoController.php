<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\News;
use App\Promo;
use App\Lelang;
use App\Vacancy;

class InfoController extends Controller
{
    /**
     * Response api dashboard
     */
    public function dashboard()
    {
        $news = News::whereHighlight(true)->limit(5)->get()->makeHidden(['slug', 'description', 'hightligh', 'status', 'order', 'created_at', 'updated_at', 'deleted_at']);
        $promo = Promo::whereHighlight(true)->limit(5)->get()->makeHidden(['slug', 'description', 'hightligh', 'status', 'order', 'created_at', 'updated_at', 'deleted_at']);
        $lelang = Lelang::whereHighlight(true)->limit(5)->get()->makeHidden(['slug', 'description', 'hightligh', 'status', 'order', 'created_at', 'updated_at', 'deleted_at']);
        return json(compact('news', 'promo', 'lelang'));
    }

    /**
     * Response all resource news
     */
    public function listNews()
    {
        $news = News::paginate(10);
        return json($news->makeHidden(['status', 'highlight', 'description', 'path_image', 'created_at', 'updated_at', 'deleted_at']));
    }

    /**
     * Response detail news
     * @param $id
     */
    public function news($id)
    {
        $news = News::find($id);
        if ($news) {
            return json($news);
        }
        return json([], 'error', 1);
    }

    /**
     * Response all resource promo
     */
    public function listPromo()
    {
        $promo = Promo::paginate(10);
        return json($promo->makeHidden(['slug', 'description', 'hightligh', 'status', 'order', 'created_at', 'updated_at', 'deleted_at']));
    }
    /**
     * Response detail promo
     * @param $id
     */
    public function promo(Promo $id)
    {
        $promo = Promo::find($id);
        if ($promo) {
            return json($promo->makeHidden(['created_at', 'updated_at', 'deleted_at']));
        }
        return json([], 'error', 1);
    }

    /**
     * Response all resource lelang
     */
    public function listLelang()
    {
        $lelang = Lelang::paginate(10);
        return json($lelang->makeHidden(['slug', 'description', 'hightligh', 'status', 'order', 'created_at', 'updated_at', 'deleted_at']));
    }

    /**
     * Response detail lelang
     * @param $id
     */
    public function lelang($id)
    {
        $lelang = Lelang::find($id);
        if ($lelang) {
            return json($lelang->makeHidden(['created_at', 'updated_at', 'deleted_at']));
        }
        return json([], 'error', 1);
    }

    /**
     * Response all resource product
     */
    public function listProduct()
    {
        $dana = Product::whereCategory('dana')->get();
        $kredit = Product::whereCategory('kredit')->get();
        return json(compact('dana', 'kredit'));
    }

    /**
     * Response detail product
     * @param $id
     */
    public function product($id)
    {
        $product = Product::find($id);
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
        $vacancies = Vacancy::where('expired', '>', now())->get();
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
}
