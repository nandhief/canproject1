<?php

namespace App\Http\Controllers;

use App\Tabungan;
use Illuminate\Http\Request;

class TabunganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tabungan = Tabungan::with('customer.user')->get();
        if (request()->ajax()) {
            foreach ($tabungan as $key => $value) {
                $data[] = collect($value)->prepend($key+1, 'no');
            }
            return response()->json(compact('data'));
        }
        return view('tabungan.index', compact('tabungan'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tabungan  $tabungan
     * @return \Illuminate\Http\Response
     */
    public function show(Tabungan $tabungan)
    {
        return view('tabungan.show', compact('tabungan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tabungan  $tabungan
     * @return \Illuminate\Http\Response
     */
    public function edit(Tabungan $tabungan)
    {
        return view('tabungan.edit', compact('tabungan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tabungan  $tabungan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tabungan $tabungan)
    {
        $request->validate([
            'status' => 'required',
            'description' => 'required',
        ]);
        $history = new History($request->all());
        $tabungan->update($request->all());
        $tabungan->histories()->save($history);
        return redirect()->route('tabungan.show', $credit->id)->withSuccess('Data Proses pengajuan tabungan berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tabungan  $tabungan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tabungan $tabungan)
    {
        $tabungan->delete();
        return redirect()->route('tabungan.index')->withSuccess('Data pengajuan tabungan ' . $kredit->customer->name . ' berhasil dihapus');
    }
}
