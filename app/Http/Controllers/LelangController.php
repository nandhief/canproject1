<?php

namespace App\Http\Controllers;

use App\Lelang;
use App\Traits\Upload;
use Illuminate\Http\Request;

class LelangController extends Controller
{
    use Upload;
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lelang = Lelang::get();
        if (request()->ajax()) {
            foreach ($lelang as $key => $value) {
                $data[] = collect($value)->prepend($key+1, 'no');
            }
            return response()->json(compact('data'), 200);
        }
        return view('lelang.index', compact('lelang'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('lelang.create');
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
        $lelang = Lelang::create($request->all());
        return redirect()->route('lelang.show', $lelang->id)->withSuccess('Data berhasil disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Lelang  $lelang
     * @return \Illuminate\Http\Response
     */
    public function show(Lelang $lelang)
    {
        return view('lelang.show', compact('lelang'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Lelang  $lelang
     * @return \Illuminate\Http\Response
     */
    public function edit(Lelang $lelang)
    {
        return view('lelang.edit', compact('lelang'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Lelang  $lelang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lelang $lelang)
    {
        $request->validate([
            'name' => 'required|max:191',
            'short_desc' => 'required',
            'description' => 'required',
        ]);
        $request = $this->saveFile($request);
        $lelang->update($request->all());
        return redirect()->route('lelang.show', $lelang->id)->withSuccess('Data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Lelang  $lelang
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lelang $lelang)
    {
        $lelang->delete();
        return redirect()->route('lelang.index')->withSuccess('Data berhasil dihapus');
    }
}
