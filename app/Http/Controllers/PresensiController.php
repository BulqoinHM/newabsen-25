<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Rule;
use App\Models\User;
use App\Models\Presence;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class PresensiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $id_guru = Auth::user()->id_guru;
        $query = Presence::where('id_guru', $id_guru)
            ->orderBy('id', 'desc');

        $count = $query->count();

        if ($count > 0) {
            $data = $query->first();
            $jam_masuk = $data->jam_masuk;
            $jam_keluar = $data->jam_keluar;
            $foto_masuk = $data->foto_masuk;
            $foto_keluar = $data->foto_keluar;
            $status = $data->status;
        } else {
            $jam_masuk = "";
            $jam_keluar = "";
            $foto_masuk = "";
            $foto_keluar = "";
            $status = "";
        }



        return view('guru.dashboardpresensi', compact('jam_masuk', 'jam_keluar', 'foto_masuk', 'foto_keluar', 'status',));
    }
    public function tes()
    {
        return view('dropdown.tes');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function absenMasuk(Request $request)
    {

        $request->validate([
            "foto_masuk" => 'mimes:jpeg,jpg,png',

        ]);

        $id_guru = Auth::user()->id_guru;
        $jam_masuk = now();

        // dd($jam_masuk);

        //validasi jadwal 
        Carbon::setLocale('id');
        $hari = Carbon::now()->translatedFormat('l');

        // 1. ketika absen cek tabel jadwal
        $cekJadwal = Schedule::where('id_guru', $id_guru)
            ->where('hari', $hari)
            ->count();
        // 2. jika ada bisa absen jika tidak ada tidak bisa absen
        if ($cekJadwal == '0') {
            Alert::toast('Maaf Anda Tidak Ada Jadwal Hari Ini!', 'error');
            return redirect('/presensi/dashboard');
        }

        DB::beginTransaction();


        try {
            if ($request->hasFile('foto_masuk')) {
                $path_loc = $request->file('foto_masuk');
                $url = $path_loc->move('storage/presensi_masuk', $path_loc->hashName());
                $valueFoto = $url->getPath() . "/" . $url->getFilename();
            } else {
                $valueFoto = '';
            }
            //store ke Presences
            Presence::create([
                'id_guru' => $id_guru,
                'jam_masuk' => $jam_masuk,
                'foto_masuk' => $valueFoto,
                'status' => '1',


            ]);


            DB::commit();

            Alert::toast('Anda berhasil absen datang!', 'success');
            return redirect('/presensi/dashboard');
        } catch (\Throwable $th) {
            //throw $th;

            DB::rollBack();
            Alert::toast('Data Gagal Ditambahkan !', 'error');
            return redirect('/presensi/dashboard');
        }
    }

    public function absenKeluar(Request $request)
    {

        $request->validate([
            "foto_masuk" => 'mimes:jpeg,jpg,png',

        ]);

        $id_guru = Auth::user()->id_guru;
        $jam_masuk = $request->jam_masuk;
        $jam_keluar = now()->format('H:i:s');
        $dateNow = now();

        // 
        Carbon::setLocale('id');
        $hari = Carbon::now()->translatedFormat('l');
        // 1. ketika absen pulang masih ada jadwal
        $cekJadwal = Schedule::where('id_guru', $id_guru)
            ->where('hari', $hari)
            ->orderBy('id', 'DESC')
            ->first();
        $jam_selesai = $cekJadwal->jam_selesai;
        // dd($jam_keluar, $jam_selesai);
        // 2. jika ada bisa absen jika tidak ada tidak bisa absen
        if ($jam_keluar < $jam_selesai) {

            if ($request->hasFile('foto_keluar')) {
                $path_loc = $request->file('foto_keluar');
                $url = $path_loc->move('storage/presensi_keluar', $path_loc->hashName());
                $valueFoto = $url->getPath() . "/" . $url->getFilename();
            } else {
                $valueFoto = '';
            }
            return view('guru.absenkeluarawal')->with([
                'valueFoto' => $valueFoto,
                'jam_masuk' => $jam_masuk
            ]);
        }
        // dd('b');
        $durasi = floor((strtotime($jam_keluar) - strtotime($jam_masuk)) / 3600);


        DB::beginTransaction();


        try {
            if ($request->hasFile('foto_keluar')) {
                $path_loc = $request->file('foto_keluar');
                $url = $path_loc->move('storage/presensi_keluar', $path_loc->hashName());
                $valueFoto = $url->getPath() . "/" . $url->getFilename();
            } else {
                $valueFoto = '';
            }
            //store ke Presences
            Presence::where('id_guru', $id_guru)
                // ->where('jam_masuk', "!=", '')
                ->whereRaw('date_format(jam_masuk,\'%Y-%m-%d\') = ?', [\Carbon\Carbon::now()->format('Y-m-d')])
                ->update([
                    'jam_keluar' => $dateNow,
                    'foto_keluar' => $valueFoto,
                    'durasi' => $durasi,
                    'status' => '1',
                ]);



            DB::commit();

            Alert::toast('Anda berhasil absen pulang!', 'success');
            return redirect('/presensi/dashboard');
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();

            Alert::toast('Data Gagal Ditambahkan!', 'error');
            return redirect('/presensi/dashboard');
        }
    }

    public function absenKeluarAwal(Request $request)
    {
        $request->validate([
            "catatan" => 'required',

        ]);

        $id_guru = Auth::user()->id_guru;
        $jam_masuk = strtotime($request->jam_masuk);
        $jam_masuk = date('H:i:s', $jam_masuk);
        $jam_keluar = now()->format('H:i:s');
        $dateNow = now();
        $catatan = $request->catatan;
        $valueFoto = $request->valueFoto;

        // 1. cek durasi berdasarkan jadwal di hari itu
        Carbon::setLocale('id');
        $hari = Carbon::now()->translatedFormat('l');
        $cekJadwal = Schedule::where('id_guru', $id_guru)
            ->where('hari', $hari)
            ->orderBy('id', 'ASC')
            ->get();
        foreach ($cekJadwal as $jadwal) {
            $durasi = 0;
            $jam_selesai = $jadwal->jam_selesai;
            if ($jam_keluar > $jam_selesai) {
                $durasi = $jadwal->durasi;
                $durasi += $durasi;
            }
            elseif ($jam_keluar <= $jam_selesai) {
                $rule = Rule::where('rule_name', 'SatJam')->first();
                $pembagi = $rule->rule_value;
                $durasi = (strtotime($jam_selesai) - strtotime($jam_keluar)) / $pembagi;
                $durasi = ceil($durasi / 60);
                $durasi += $durasi;
            } else {
                $durasi = 0;
                $durasi += $durasi;
            }
            // $durasi++;
        }

        // 2. cek durasi telat dari jadwal di hari itu
        $cekJadwalTelat = Schedule::where('id_guru', $id_guru)
            ->where('hari', $hari)
            ->where('jam_mulai', '<', $jam_masuk)
            ->orderBy('id', 'ASC')
            ->get();
        // dd($cekJadwalTelat);
        foreach ($cekJadwalTelat as $jadwalTelat) {
            // $durasiTelat = 0;
            $jam_selesai = $jadwalTelat->jam_selesai;

            if ($jam_selesai < $jam_masuk) {
                $durasiTelat = $jadwalTelat->durasi;
                $durasiTelat += $durasiTelat;
            }
        }
        $durasiTotal = $durasi - $durasiTelat;
dd($durasi, $durasiTelat, $durasiTotal, $cekJadwalTelat, $jam_keluar);
        DB::beginTransaction();


        try {
            //store ke Presences
            Presence::where('id_guru', $id_guru)
                // ->where('jam_masuk', "!=", '')
                ->whereRaw('date_format(jam_masuk,\'%Y-%m-%d\') = ?', [\Carbon\Carbon::now()->format('Y-m-d')])
                ->update([
                    'jam_keluar' => $dateNow,
                    'foto_keluar' => $valueFoto,
                    'durasi' => $durasiTotal,
                    'status' => '0',
                    'catatan' => $catatan,

                ]);



            DB::commit();
            Alert::toast('Anda berhasil absen pulang!', 'success');
            return redirect('/presensi/dashboard');
        } catch (\Throwable $th) {
            //throw $th;

            DB::rollBack();
            Alert::toast('Data Gagal Ditambahkan', 'error');
            return redirect('/presensi/dashboard');
        }
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
