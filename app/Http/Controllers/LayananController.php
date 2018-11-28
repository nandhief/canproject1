<?php

namespace App\Http\Controllers;

use App\Layanan;
use App\Traits\Upload;
use Illuminate\Http\Request;

class LayananController extends Controller
{
    use Upload;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $layanan = Layanan::orderBy('id', 'desc')->get();
        if (request()->ajax()) {
            foreach ($layanan as $key => $value) {
                $data[] = collect($value)->prepend($key+1, 'no');
            }
            return response()->json(compact('data'), 200);
        }
        return view('layanan.index', compact('layanan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('layanan.create');
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
        $layanan = Layanan::create($request->all());
        return redirect()->route('layanan.show', $layanan->id)->withSuccess('Data berhasil disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Layanan  $layanan
     * @return \Illuminate\Http\Response
     */
    public function show(Layanan $layanan)
    {
        return view('layanan.show', compact('layanan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Layanan  $layanan
     * @return \Illuminate\Http\Response
     */
    public function edit(Layanan $layanan)
    {
        return view('layanan.edit', compact('layanan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Layanan  $layanan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Layanan $layanan)
    {
        $request->validate([
            'name' => 'required|max:191',
            'short_desc' => 'required',
            'description' => 'required',
        ]);
        $request = $this->saveFile($request);
        $layanan->update($request->all());
        return redirect()->route('layanan.show', $layanan->id)->withSuccess('Data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Layanan  $layanan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Layanan $layanan)
    {
        $layanan->delete();
        return redirect()->route('layanan.index')->withSuccess('Data berhasil dihapus');
    }
}
