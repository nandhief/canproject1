<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\News;
use App\Promo;
use App\Lelang;

class InfoController extends Controller
{
    /**
     * Response api dashboard
     */
    public function dashboard()
    {
        $news = News::whereHighlight(true)->limit(5)->get()->makeHidden(['slug', 'description', 'hightligh', 'status', 'order', 'created_at', 'updated-at', 'deleted_at']);
        $promo = Promo::whereHighlight(true)->limit(5)->get()->makeHidden(['slug', 'description', 'hightligh', 'status', 'order', 'created_at', 'updated-at', 'deleted_at']);
        $lelang = Lelang::whereHighlight(true)->limit(5)->get()->makeHidden(['slug', 'description', 'hightligh', 'status', 'order', 'created_at', 'updated-at', 'deleted_at']);
        return json(compact('news', 'promo', 'lelang'));
    }

    /**
     * Response all resource news
     */
    public function listNews()
    {
        $news = News::get();
        return json($news);
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
        $promo = Promo::get();
        return json($promo);
    }
    /**
     * Response detail promo
     * @param $id
     */
    public function promo(Promo $id)
    {
        $promo = Promo::find($id);
        if ($promo) {
            return json($promo);
        }
        return json([], 'error', 1);
    }

    /**
     * Response all resource lelang
     */
    public function listLelang()
    {
        $lelang = Lelang::get();
        return json($lelang);
    }

    /**
     * Response detail lelang
     * @param $id
     */
    public function lelang($id)
    {
        $lelang = Lelang::find($id);
        if ($lelang) {
            return json($lelang);
        }
        return json([], 'error', 1);
    }

    /**
     * Response all resource product
     */
    public function listProduct()
    {
        $products = Product::get();
        return json($products);
    }

    /**
     * Response detail product
     * @param $id
     */
    public function product($id)
    {
        $product = Product::find($id);
        if ($product) {
            return json($product);
        }
        return json([], 'error', 1);
    }
}
