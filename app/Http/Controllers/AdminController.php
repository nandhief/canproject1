<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class AdminController extends Controller
{
    public function index()
    {
        $data = [];
        $admin = User::whereRaw('admin = 1 AND id != 1')->get();
        if (request()->ajax()) {
            foreach ($admin as $key => $value) {
                $data[] = collect($value)->prepend($key+1, 'no');
            }
            return response()->json(compact('data'));
        }
        return view('settings.admin', compact('admin'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);
        $admin = User::create($request->all());
        $admin->admin = true;
        $admin->save();
        return response()->json(['success' => $admin->name . ' berhasil ditambahkan']);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]);
        $admin = User::find($id);
        $admin->update($request->all());
        return response()->json(['success' => $admin->name . ' berhasil diupdate']);
    }

    public function destroy($id)
    {
        $admin = User::find($id);
        $admin->delete();
        return redirect()->route('admin.index')->withSuccess($admin->name . ' berhasil dihapus');
    }
}
