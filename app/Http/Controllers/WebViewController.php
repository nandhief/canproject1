<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Layanan;
use App\Lelang;
use App\News;
use App\Product;
use App\Promo;

class WebViewController extends Controller
{
    public function index($type, $id)
    {
        switch ($type) {
            case 'layanan':
                $data = Layanan::find($id)->description;
                break;
            case 'lelang':
                $data = Lelang::find($id)->description;
                break;
            case 'news':
                $data = News::find($id)->description;
                break;
            case 'product':
                $data = Product::find($id)->description;
                break;
            case 'promo':
                $data = Promo::find($id)->description;
                break;
        }
        return view('webview', compact('data'));
    }
}
