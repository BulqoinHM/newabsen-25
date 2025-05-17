<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\User;
use App\Models\Presence;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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



        return view('guru.dashboardpresensi', compact('jam_masuk', 'jam_keluar','foto_masuk','foto_keluar','status',));
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
            return redirect('/presensi/dashboard')->with('failed', 'Anda tidak ada jadwal hari ini.');
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

            return redirect('/presensi/dashboard')->with('success', 'Berhasil Absen Masuk');
        } catch (\Throwable $th) {
            //throw $th;

            DB::rollBack();
            return redirect('/presensi/dashboard')->with('failed', 'Data Gagal ditambahkan.');
        }
    }

    public function absenKeluar(Request $request)
    {

        $request->validate([
            "foto_masuk" => 'mimes:jpeg,jpg,png',

        ]);

        $id_guru = Auth::user()->id_guru;
        $jam_masuk = $request->jam_masuk;
        $jam_keluar = now();

        // 
        Carbon::setLocale('id');
        $hari = Carbon::now()->translatedFormat('l');
        // 1. ketika absen pulang masih ada jadwal
        $cekJadwal = Schedule::where('id_guru', $id_guru)
            ->where('hari', $hari)
            ->orderBy('id', 'DESC')
            ->first();
        $jam_selesai = $cekJadwal->jam_selesai;
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
                'valueFoto'=>$valueFoto,
                'jam_masuk'=>$jam_masuk
            ]);
        }

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
                    'jam_keluar' => $jam_keluar,
                    'foto_keluar' => $valueFoto,
                    'durasi' => $durasi,
                    'status' => '1',
                ]);



            DB::commit();

            return redirect('/presensi/dashboard')->with('success', 'Berhasil Absen Keluar');
        } catch (\Throwable $th) {
            throw $th;

            DB::rollBack();
            return redirect('/presensi/dashboard')->with('failed', 'Data Gagal ditambahkan.');
        }
    }

    public function absenKeluarAwal(Request $request)
    {
         $request->validate([
            "catatan" => 'required',

        ]);

        $id_guru = Auth::user()->id_guru;
        $jam_masuk = $request->jam_masuk;
        $jam_keluar = now();
        $catatan = $request->catatan;
        $valueFoto = $request->valueFoto;

        $durasi = floor((strtotime($jam_keluar) - strtotime($jam_masuk)) / 3600);

        // dd($durasi, $jam_masuk, $jam_keluar);
        DB::beginTransaction();


        try {
            //store ke Presences
            Presence::where('id_guru', $id_guru)
                // ->where('jam_masuk', "!=", '')
                ->whereRaw('date_format(jam_masuk,\'%Y-%m-%d\') = ?', [\Carbon\Carbon::now()->format('Y-m-d')])
                ->update([
                    'jam_keluar' => $jam_keluar,
                    'foto_keluar' => $valueFoto,
                    'durasi' => $durasi,
                    'status' => '0',
                    'catatan' => $catatan,

                ]);



            DB::commit();

            return redirect('/presensi/dashboard')->with('success', 'Berhasil Absen Keluar');
        } catch (\Throwable $th) {
            throw $th;

            DB::rollBack();
            return redirect('/presensi/dashboard')->with('failed', 'Data Gagal ditambahkan.');
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
