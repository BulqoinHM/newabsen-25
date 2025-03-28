<?php

namespace App\Http\Controllers;

use App\Models\Rule;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "hari" => 'required',
            "jam_mulai" => 'required|before:jam_selesai',
            "jam_selesai" => 'required',
            "id_mapel" => 'required',


        ],[
            'jam_mulai.before' => 'Jam Mulai Harus Sebelum Jam Selesai',
        ]);

        $id_guru = decrypt($request->id_guru);    
        $hari = $request->hari;
        $jam_mulai = $request->jam_mulai;
        $jam_selesai = $request->jam_selesai;
        $id_mapel = $request->id_mapel;
        $rule = Rule::where('rule_name','SatJam')->first();
        $pembagi = $rule->rule_value;
        $selisih = strtotime($jam_selesai) - strtotime($jam_mulai);
        $selisihmenit = $selisih / $pembagi;
        $durasi = $selisihmenit / 60;
   
        DB::beginTransaction();

        try {
            //store ke Schedule
            Schedule::create([
                'id_guru' => $id_guru,
                'hari' => $hari,
                'jam_mulai' => $jam_mulai,
                'jam_selesai' => $jam_selesai,
                'id_mapel' => $id_mapel,
                'durasi' => $durasi,
            ]);

            DB::commit();

            return redirect('/guru/show/' . encrypt($id_guru))->with('success', 'Data berhasil ditambahkan.');
        } catch (\Throwable $th) {
            //throw $th;
            dd($th);
            DB::rollBack();
            return redirect('/guru/show/' . encrypt($id_guru))->with('failed', 'Data Gagal ditambahkan.');
        }
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
    public function delete($id)
    {
        $id = decrypt($id);

        $count = Schedule::where('id', $id)->count();

        if ($count > 0) {
            DB::beginTransaction();

            try {
                $mapel = Schedule::find($id);
                $mapel->delete();

                DB::commit();

                return redirect()->back()->with('success', 'Data Berhasil Dihapus!!!!');
            } catch (\Throwable $th) {
                //throw $th;
                
                DB::rollBack();
                return redirect()->back();
            }
        }
    }
}
