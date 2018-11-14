<?php

namespace App\Http\Controllers;

use App\Valas;
use Illuminate\Http\Request;
use App\Traits\Upload;

class ValasController extends Controller
{
    use Upload;
    
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('valas.create');
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
            'short_desc' => 'required',
            'description' => 'required',
        ]);
        $request = $this->saveFile($request);
        $valas = Valas::create($request->all());
        return redirect()->route('valas.show', $valas->id)->withSuccess('Data berhasil disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  Int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $valas = Valas::find($id);
        return view('valas.show', compact('valas'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $valas = Valas::find($id);
        return view('valas.edit', compact('valas'));
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
            'short_desc' => 'required',
            'description' => 'required',
        ]);
        $request = $this->saveFile($request);
        $valas = Valas::find($id);
        $valas->update($request->all());
        return redirect()->route('valas.show', $valas->id)->withSuccess('Data berhasil diupdate');
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
