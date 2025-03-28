<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Mapel;
use App\Models\Dropdown;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class MapelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dropdown['Kelas'] = Dropdown::where('kategori', 'Kelas')->orderBy('nilai', 'asc')->get();
        $dropdown['Jurusan'] = Dropdown::where('kategori', 'Jurusan')->orderBy('nilai', 'asc')->get();
        $dropdown['Mapel'] = Dropdown::where('kategori', 'Mapel')->orderBy('nilai', 'asc')->get();
        $data = Mapel::get();

        return view('mapel.index-map',compact('dropdown','data'));
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
            "kode_mapel" => 'required',
            "nama_mapel" => 'required',
            "kelas" => 'required',
            "jurusan" => 'required',


        ]);

        $kode_mapel = $request->kode_mapel;
        $nama_mapel = $request->nama_mapel;
        $kelas = $request->kelas;
        $jurusan = $request->jurusan;
     

        DB::beginTransaction();


        try {
            //store ke Dropdowns
            Mapel::create([
                'kode_mapel' => $kode_mapel,
                'nama_mapel' => $nama_mapel,
                'kelas' => $kelas,
                'jurusan' => $jurusan,
     

            ]);

            DB::commit();

            return redirect('/mapel')->with('success', 'Data berhasil ditambahkan.');
        } catch (\Throwable $th) {
            //throw $th;
       
            DB::rollBack();
            return redirect('/mapel')->with('failed', 'Data Gagal ditambahkan.');
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
        $id = decrypt($id);

        $request->validate([
            "kode_mapel" => 'required',
            "nama_mapel" => 'required',
            "kelas" => 'required',
            "jurusan" => 'required',
    


        ]);

        $kode_mapel = $request->kode_mapel;
        $nama_mapel = $request->nama_mapel;
        $kelas = $request->kelas;
        $jurusan = $request->jurusan;
      

        DB::beginTransaction();

        try {
            Mapel::where('id', $id)
                ->update([
                    'kode_mapel' => $kode_mapel,
                    'nama_mapel' => $nama_mapel,
                    'kelas' => $kelas,
                    'jurusan' => $jurusan,
               
                ]);
            DB::commit();

            return redirect('/mapel')->with('success', 'Data berhasil diubah.');
        } catch (\Throwable $th) {
            //throw $th;
            
            DB::rollBack();
            return redirect('/mapel')->with('failed', 'Data Gagal diubah.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
        $id = decrypt($id);

        $count = Mapel::where('id', $id)->count();

        if ($count > 0) {
            DB::beginTransaction();

            try {
                $mapel = Mapel::find($id);
                $mapel->delete();

                DB::commit();

                return redirect('/mapel')->with('success', 'Data Berhasil Dihapus!!!!');
            } catch (\Throwable $th) {
                //throw $th;
                
                DB::rollBack();
                return redirect()->back();
            }
        }
    }
}
