<?php

namespace App\Http\Controllers;

use App\Models\Dropdown;
use App\Models\Guru;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dropdown['Jabatan'] = Dropdown::where('kategori','Jabatan')->orderBy('nilai','asc')->get();
        $dropdown['JK'] = Dropdown::where('kategori','JK')->orderBy('nilai','asc')->get();
        $dropdown['Role'] = Dropdown::where('kategori','Role')->orderBy('nilai','asc')->get();
        $datas = Guru::all();

        return view('guru.index-g',compact('dropdown','datas'));
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
            "kode_guru" => 'required',
            "nama_guru" => 'required',
            "jk" => 'required',
            "tgllahir" => 'required',
            "jabatan" => 'required',
            "email" => 'required',
            "password" => 'required',
            "role" => 'required',
            "foto" => 'mimes:jpeg,jpg,png',
                    
        ]);

        DB::beginTransaction();

        $kode_guru = $request->kode_guru;
        $nama_guru = $request->nama_guru;
        $jk = $request->jk;
        $tgllahir = $request->tgllahir;
        $jabatan = $request->jabatan;
        $notelp = $request->notelp;
        $email = $request->email;
        $password = $request->password;
        $role = $request->role;

        try {
            if($request->hasFile('foto')){
                $path_loc = $request->file('foto');
                $url = $path_loc->move('storage/foto_guru', $path_loc->hashName());
                $valueFoto = $url->getPath() . "/" . $url->getFilename();
            }else{
                $valueFoto = '';
            }
                //store ke Guru
                $storeGuru = Guru::create([
                    'kode_guru' => $kode_guru,
                    'nama_guru' => $nama_guru,
                    'jk' => $jk,
                    'tgllahir' => $tgllahir,
                    'jabatan' => $jabatan,
                    'notelp' => $notelp,
                    'foto' => $valueFoto,
                ]);

                $id_guru = $storeGuru->id;
                //store ke Users
                User::create([
                    'name' => $nama_guru,
                    'email' => $email,
                    'password' => $password,
                    'id_guru' => $id_guru,
                    'kode_guru' => $kode_guru,
                    'role' => $role,
                ]);

            DB::commit();

            return redirect('/guru')->with('success', 'Data berhasil ditambahkan.');
        } catch (\Throwable $th) {
            //throw $th;
   
            DB::rollBack();
            return redirect('/guru')->with('failed', 'Data Gagal ditambahkan.');
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
    public function destroy(string $id)
    {
        //
    }
}
