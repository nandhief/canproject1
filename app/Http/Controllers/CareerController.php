<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Career;
use App\Mail\CareerMail;

class CareerController extends Controller
{
    public function index()
    {
        $careers = Career::get();
        if (request()->ajax()) {
            foreach ($careers as $key => $value) {
                $data[] = collect($value)->prepend($key+1, 'no');
            }
            return response()->json(compact('data'));
        }
        return view('careers.index', compact('careers'));
    }

    public function show(Career $career)
    {
        return view('careers.show', compact('career'));
    }

    public function update(Request $request, Career $career)
    {
        $request->validate([
            'keterangan' => 'required',
        ]);
        if ($request->reply) {
            $data = (object) array_merge($request->all(), $career->makeHidden(['reply'])->toArray());
            \Mail::to($career->email, $career->name)->send(new CareerMail($data));
        }
        $career->update(array_merge($request->all(), ['status' => true]));
        return redirect()->route('careers.show', $career->id)->withSuccess('Tanggapan ke pelamar sudah dikirim');
    }

    public function destroy(Career $career)
    {
        $career->delete();
        return redirect()->route('careers.index');
    }
}
