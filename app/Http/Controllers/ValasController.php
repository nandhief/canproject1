<?php

namespace App\Http\Controllers;

use App\Valas;
use Illuminate\Http\Request;

class ValasController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $valas = Valas::get();
        if (request()->ajax()) {
            foreach ($valas as $key => $value) {
                $data[] = collect($value)->prepend($key+1, 'no');
            }
            return response()->json(compact('data'));
        }
        return view('valas.index', compact('valas'));
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
            'name' => 'required',
            'symbol' => 'required',
            'buy' => 'required',
            'sell' => 'required',
        ]);
        $valas = Valas::create($request->all());
        return response()->json(['success' => 'Data ' . $valas->name . ' berhasil disimpan']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'symbol' => 'required',
            'buy' => 'required',
            'sell' => 'required',
        ]);
        $valas = Valas::find($id);
        $valas->update($request->all());
        return response()->json(['success' => 'Data ' . $valas->name . ' berhasil diupdate']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $valas = Valas::find($id);
        $valas->delete();
        return redirect()->route('valas.index')->withSuccess('Data berhasil dihapus');
    }
}
