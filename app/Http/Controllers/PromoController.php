<?php

namespace App\Http\Controllers;

use App\Promo;
use App\Modul\FirebasePush as Push;
use App\Modul\Firebase;
use App\Traits\Upload;
use Illuminate\Http\Request;

class PromoController extends Controller
{
    use Upload;
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $promos = Promo::orderBy('id', 'desc')->get();
        if (request()->ajax()) {
            foreach ($promos as $key => $value) {
                $data[] = collect($value)->prepend($key+1, 'no');
            }
            return response()->json(compact('data'), 200);
        }
        return view('promos.index', compact('promos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('promos.create');
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
            'expired' => 'required',
        ]);
        $request = $this->saveFile($request);
        $data = array_merge($request->all(), ['expired' => now()->parse($request->expired)->addHours(23)->addMinutes(59)]);
        $promo = Promo::create($data);
        return redirect()->route('promos.show', $promo->id)->withSuccess('Data berhasil disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Promo  $promo
     * @return \Illuminate\Http\Response
     */
    public function show(Promo $promo)
    {
        return view('promos.show', compact('promo'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Promo  $promo
     * @return \Illuminate\Http\Response
     */
    public function edit(Promo $promo)
    {
        return view('promos.edit', compact('promo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Promo  $promo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Promo $promo)
    {
        $request->validate([
            'name' => 'required|max:191',
            'short_desc' => 'required',
            'description' => 'required',
            'expired' => 'required',
        ]);
        $request = $this->saveFile($request);
        $data = array_merge($request->all(), ['expired' => now()->parse($request->expired)->addHours(23)->addMinutes(59)]);
        $promo->update($data);
        return redirect()->route('promos.show', $promo->id)->withSuccess('Data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Promo  $promo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Promo $promo)
    {
        $promo->delete();
        return redirect()->route('promos.index')->withSuccess('Data berhasil dihapus');
    }
}
