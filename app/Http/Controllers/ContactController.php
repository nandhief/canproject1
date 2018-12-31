<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Contact;
use App\Setting;

class ContactController extends Controller
{
    public function index()
    {
        $socials = Setting::social();
        $data = [];
        $contacts = Contact::get();
        if (request()->ajax()) {
            foreach ($contacts as $key => $value) {
                $data[] = collect($value)->prepend($key+1, 'no');
            }
            return response()->json(compact('data'));
        }
    	return view('contact.index', compact('contacts', 'socials'));
    }

    public function create()
    {
    	return view('contact/create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'posisi' => 'required',
            'name' => 'required',
            'telp' => 'required',
            'alamat' => 'required',
            'latitude' => 'required',
            'longitude' => 'required'
        ]);
        if (Contact::wherePosisi($request->posisi)->first()) {
            return redirect()->back()->withErrors('Kantor Pusat Hanya Boleh Satu');
        }
        $table = Contact::create($request->all());
        return redirect()->route('contacts.index')->withSuccess('Data Berhasil Disimpan');
    }

    public function edit($id)
    {
        $table = Contact::findOrFail($id);
        return view('contact/edit', ['data' => $table]);
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'posisi' => 'required',
            'name' => 'required',
            'telp' => 'required',
            'alamat' => 'required',
            'latitude' => 'required',
            'longitude' => 'required'
        ]);
        $table = Contact::find($id);
        if (strtolower($table->posisi) == $request->posisi) {
        } else if (Contact::wherePosisi($request->posisi)->first()) {
            return redirect()->back()->withErrors('Kantor Pusat Hanya Boleh Satu');
        }
        $table->update($request->all());
        return redirect()->route('contacts.index')->withSuccess('Data Berhasil Diupdate');
    }

    public function destroy($id)
    {
        $table = Contact::findOrFail($id);
        $table->delete();
        return redirect()->route('contacts.index')->withSuccess('Data Berhasil Dihapus');
    }
}
