<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Career;
use App\Vacancy;
use App\Mail\CareerMail;
use App\Modul\FirebasePush as Push;
use App\Modul\Firebase;
use App\Setting;
use App\User;

class CareerController extends Controller
{
    public function index()
    {
        $data_careers = [];
        $data_vacancies = [];
        $careers = Career::with('vacancy')->orderBy('id', 'desc')->get();
        $vacancies = Vacancy::orderBy('id', 'desc')->get();
        if (request()->ajax()) {
            foreach ($careers as $key => $value) {
                $data_careers[] = collect($value)->prepend($key+1, 'no');
            }
            foreach ($vacancies as $key => $value) {
                $data_vacancies[] = collect($value)->prepend($key+1, 'no');
            }
            return response()->json(compact('data_careers', 'data_vacancies'));
        }
        return view('careers.index', compact('careers', 'vacancies'));
    }

    public function create()
    {
        return view('careers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'lokasi' => 'required',
            'jenis' => 'required',
            'kualifikasi' => 'required',
            'fasilitas' => 'required',
            'expired' => 'required',
        ]);
        $data = array_merge($request->all(), ['expired' => now()->parse($request->expired)->addHours(23)->addMinutes(59)]);
        $vacancy = Vacancy::create($data);
        return redirect()->route('careers.vacancy', $vacancy->id)->withSuccess('Data lowongan karir berhasil disimpan');
    }

    public function detail(Vacancy $vacancy)
    {
        return view('careers.detail', compact('vacancy'));
    }

    public function vacancyEdit(Vacancy $vacancy)
    {
        return view('careers.edit', compact('vacancy'));
    }

    public function vacancyUpdate(Request $request, Vacancy $vacancy)
    {
        $request->validate([
            'name' => 'required',
            'lokasi' => 'required',
            'jenis' => 'required',
            'kualifikasi' => 'required',
            'fasilitas' => 'required',
            'expired' => 'required',
        ]);
        $data = array_merge($request->all(), ['expired' => now()->parse($request->expired)->addHours(23)->addMinutes(59)]);
        $vacancy->update($data);
        return redirect()->route('careers.vacancy', $vacancy->id)->withSuccess('Data lowongan karir berhasil update');
    }

    public function vacancyDelete(Vacancy $vacancy)
    {
        $vacancy->delete();
        return redirect()->route('careers.index')->withSuccess('Data lowongan karir berhasil dihapus');
    }

    public function show(Career $career)
    {
        return view('careers.show', compact('career'));
    }

    public function update(Request $request, Career $career, Push $push, Firebase $firebase)
    {
        $request->validate([
            'keterangan' => 'required',
        ]);
        if ($request->reply) {
            $data = (object) array_merge($request->all(), $career->makeHidden(['reply'])->toArray());
            \Mail::to($career->email, $career->name)->send(new CareerMail($data));
        }
        $push->setTitle('BPR MAA MOBILE');
        $push->setMessage('Info Pengajuan Lamaran: ' . $request->keterangan);
        $push->setImage(null);
        $push->setIsBackground(FALSE);
        $push->setPayload("tabungan");
        if ($user = User::whereEmail($career->email)->first()) {
            $firebase->send($user->fcm_token, ['body' => 'Info Pengajuan Lamaran: ' . $request->keterangan], $push->getPush());
        }
        $notification = 'Permeritahuan: Admin ' . auth()->user()->name . '(' . auth()->user()->email . ') sedang menanggapi karir ' . $career->vacancy->name . ' dari pelamar ' . $career->name . '(' . $career->email . '): ' . $request->keterangan . ($request->reply ? strip_tags('#' . $request->reply) : '');
        \Mail::raw($notification, function ($message) {
            $message->from(Setting::mail()->server->email, 'BPR MAA Mobile Backend');
            $message->to(Setting::mail()->career->email);
            $message->subject('Karir BPR MAA Mobile Apps');
        });
        $career->update(array_merge($request->all(), ['status' => true]));
        return redirect()->route('careers.show', $career->id)->withSuccess('Tanggapan ke pelamar sudah dikirim');
    }

    public function destroy(Career $career)
    {
        $career->delete();
        return redirect()->route('careers.index')->withSuccess('Data Pelamar berhasil dihapus');
    }
}
