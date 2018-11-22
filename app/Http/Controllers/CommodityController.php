<?php

namespace App\Http\Controllers;

use App\Commodity;
use Illuminate\Http\Request;

class CommodityController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];
        $commodities = Commodity::get();
        if (request()->ajax()) {
            foreach ($commodities as $key => $value) {
                $data[] = collect($value)->prepend($key+1, 'no');
            }
            return response()->json(compact('data'), 200);
        }
        return view('commodities.index', compact('commodities'));
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
        $commoditi = Commodity::create($request->all());
        return response()->json(['success' => 'Data ' . $commoditi->name . ' berhasil disimpan']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Commodity  $commodity
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Commodity $commodity)
    {
        $request->validate([
            'name' => 'required',
            'symbol' => 'required',
            'buy' => 'required',
            'sell' => 'required',
        ]);
        $commodity->update($request->all());
        return response()->json(['success' => 'Data ' . $commodity->name . ' berhasil diupdate']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Commodity  $commodity
     * @return \Illuminate\Http\Response
     */
    public function destroy(Commodity $commodity)
    {
        $commodity->delete();
        return redirect()->route('commodities.index')->withSuccess('Data berhasil dihapus');
    }
}
