<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Corporate;

class CorporateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];
        $corporates = Corporate::get();
        if (request()->ajax()) {
            foreach ($corporates as $key => $value) {
                $data[] = collect($value)->prepend($key+1, 'no');
            }
            return response()->json(compact('data'));
        }
        return view('corporate/index', compact('corporates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('corporate/create');
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
            'name'       => 'required',
            'jabatan'    => 'required',
            'bagian'        => 'required',
            'path_foto'       => 'required|image'
        ]);
        if ($request->hasFile('path_foto')) {
            $filename = date('YmdHis_') . $request->path_foto->getClientOriginalName();
            $request->path_foto->move('./storage/original', $filename);
            $request = new Request(array_merge($request->all(), ['path_foto' => $filename]));
        }
        $corporate = Corporate::create($request->all());
        return redirect()->route('corporates.index')->withSuccess('Data '. $corporate->name . ' berhasil disimpan');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $table = Corporate::findOrFail($id);
        return view('corporate/edit', ['data' => $table]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'       => 'required',
            'jabatan'    => 'required',
            'bagian'        => 'required',
        ]);
        if ($request->hasFile('path_foto')) {
            $filename = date('YmdHis_') . $request->path_foto->getClientOriginalName();
            $request->path_foto->move('./storage/original', $filename);
            $request = new Request(array_merge($request->all(), ['path_foto' => $filename]));
        }
        $corporate = Corporate::find($id);
        $corporate->update($request->all());
        return redirect()->route('corporates.index')->withSuccess('Data '. $corporate->name . ' berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $corporate = Corporate::findOrFail($id);
        $corporate->delete();
        return redirect()->route('corporates.index')->withSuccess('Data '. $corporate->name . ' berhasil disimpan');
    }
}
