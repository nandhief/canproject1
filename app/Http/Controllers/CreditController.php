<?php

namespace App\Http\Controllers;

use App\Credit;
use App\History;
use Illuminate\Http\Request;

class CreditController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $credits = Credit::with('customer.user')->get();
        if (request()->ajax()) {
            foreach ($credits as $key => $value) {
                $data[] = collect($value)->prepend($key+1, 'no');
            }
            return response()->json(compact('data'));
        }
        return view('credits.index', compact('credits'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Credit  $credit
     * @return \Illuminate\Http\Response
     */
    public function show(Credit $credit)
    {
        return view('credits.show', compact('credit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Credit  $credit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Credit $credit)
    {
        $request->validate([
            'status' => 'required',
            'description' => 'required',
        ]);
        $history = new History($request->all());
        $credit->update($request->all());
        $credit->histories()->save($history);
        return redirect()->route('credits.show', $credit->id)->withSuccess('Data Proses pengajuan kredit berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Credit  $credit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Credit $credit)
    {
        $credit->delete();
        return redirect()->route('credits.index')->withSuccess('Data pengajuan kredit ' . $kredit->customer->name . ' berhasil dihapus');
    }
}
