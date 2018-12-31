<?php

namespace App\Http\Controllers;

use App\Credit;
use App\History;
use App\Mail\HistoryMail;
use App\Modul\FirebasePush as Push;
use App\Modul\Firebase;
use Illuminate\Http\Request;
use App\Setting;

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
    public function update(Request $request, Credit $credit, Push $push, Firebase $firebase)
    {
        $request->validate([
            'status' => 'required',
            'description' => 'required',
        ]);
        $history = new History($request->all());
        $credit->update($request->all());
        $credit->histories()->save($history);
        $push->setTitle('BPR MAA MOBILE');
        $push->setMessage('Riwayat Pengajuan Kredit: ' . $request->description);
        $push->setImage(null);
        $push->setIsBackground(FALSE);
        $push->setPayload("credit");
        $firebase->send($credit->customer->user->fcm_token, ['body' => 'Riwayat Pengajuan Kredit: ' . $request->description], $push->getPush());
        if ($request->reply) {
            $history = (object) [
                'name' => $credit->customer->user->name,
                'email' => $credit->customer->user->email,
                'reply' => $request->reply,
                'category' => 'PENGAJUAN KREDIT',
            ];
            \Mail::to($credit->customer->user->email, $credit->customer->user->name)->send(new HistoryMail($history));
        }
        $notification = 'Permeritahuan: Admin ' . auth()->user()->name . '(' . auth()->user()->email . ') sedang menanggapi pengajuan kredit dari pengguna ' . $credit->customer->user->name . '(' . $credit->customer->user->email . '): ' . $request->description . ($request->reply ? strip_tags('#' . $request->reply) : '');
        \Mail::raw($notification, function ($message) {
            $message->from(Setting::mail()->server->email, 'BPR MAA Mobile Backend');
            $message->to(Setting::mail()->kredit->email);
            $message->subject('Kredit BPR MAA Mobile Apps');
        });
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
        return redirect()->route('credits.index')->withSuccess('Data pengajuan kredit ' . $credit->customer->name . ' berhasil dihapus');
    }
}
