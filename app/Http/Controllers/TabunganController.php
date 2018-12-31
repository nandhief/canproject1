<?php

namespace App\Http\Controllers;

use App\Tabungan;
use App\History;
use App\Mail\HistoryMail;
use App\Modul\FirebasePush as Push;
use App\Modul\Firebase;
use Illuminate\Http\Request;
use App\Setting;

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
    public function update(Request $request, Tabungan $tabungan, Push $push, Firebase $firebase)
    {
        $request->validate([
            'status' => 'required',
            'description' => 'required',
        ]);
        $history = new History($request->all());
        $tabungan->update($request->all());
        $tabungan->histories()->save($history);
        $push->setTitle('BPR MAA MOBILE');
        $push->setMessage('Riwayat Pengajuan Tabungan: ' . $request->description);
        $push->setImage(null);
        $push->setIsBackground(FALSE);
        $push->setPayload("tabungan");
        $firebase->send($tabungan->customer->user->fcm_token, ['body' => 'Riwayat Pengajuan Tabungan: ' . $request->description], $push->getPush());
        if ($request->reply) {
            $history = (object) [
                'name' => $tabungan->customer->user->name,
                'email' => $tabungan->customer->user->email,
                'reply' => $request->reply,
                'category' => 'PENGAJUAN TABUNGAN',
            ];
            \Mail::to($tabungan->customer->user->email, $tabungan->customer->user->name)->send(new HistoryMail($history));
        }
        $notification = 'Permeritahuan: Admin ' . auth()->user()->name . '(' . auth()->user()->email . ') sedang menanggapi pengajuan tabungan dari pengguna ' . $credit->customer->user->name . '(' . $credit->customer->user->email . '): ' . $request->description . ($request->reply ? strip_tags('#' . $request->reply) : '');
        \Mail::raw($notification, function ($message) {
            $message->from(Setting::mail()->server->email, 'BPR MAA Mobile Backend');
            $message->to(Setting::mail()->tabungan->email);
            $message->subject('Tabungan BPR MAA Mobile Apps');
        });
        return redirect()->route('tabungan.show', $tabungan->id)->withSuccess('Data Proses pengajuan tabungan berhasil diupdate');
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
        return redirect()->route('tabungan.index')->withSuccess('Data pengajuan tabungan ' . $tabungan->customer->name . ' berhasil dihapus');
    }
}
