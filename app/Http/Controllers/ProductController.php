<?php

namespace App\Http\Controllers;

use App\Product;
use App\Traits\Upload;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    use Upload;
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dana = Product::whereCategory('dana')->orderBy('id', 'desc')->get();
        $kredit = Product::whereCategory('kredit')->orderBy('id', 'desc')->get();
        if (request()->ajax()) {
            foreach ($dana as $key => $value) {
                $data_dana[] = collect($value)->prepend($key+1, 'no');
            }
            foreach ($kredit as $key => $value) {
                $data_kredit[] = collect($value)->prepend($key+1, 'no');
            }
            return response()->json(compact('data_dana', 'data_kredit'));
        }
        return view('products.index', compact('dana', 'kredit'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if ($category = ucwords(request()->category)) {
            return view('products.create', compact('category'));
        }
        return abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:191',
            'short_desc' => 'required',
            'description' => 'required',
        ]);
        $request = $this->saveFile($request);
        $product = Product::create($request->all());
        return redirect()->route('products.show', $product->id)->withSuccess('Data berhasil disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|max:191',
            'short_desc' => 'required',
            'description' => 'required',
        ]);
        $request = $this->saveFile($request);
        $product->update($request->all());
        return redirect()->route('products.show', $product->id)->withSuccess('Data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->withSuccess('Data berhasil dihapus');
    }
}
