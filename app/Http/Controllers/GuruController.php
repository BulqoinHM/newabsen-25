<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\User;
use App\Models\Mapel;
use App\Models\Dropdown;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dropdown['Jabatan'] = Dropdown::where('kategori', 'Jabatan')->orderBy('nilai', 'asc')->get();
        $dropdown['JK'] = Dropdown::where('kategori', 'JK')->orderBy('nilai', 'asc')->get();
        $dropdown['Role'] = Dropdown::where('kategori', 'Role')->orderBy('nilai', 'asc')->get();

        $datas = Guru::get();
  
        return view('guru.index-g', compact('dropdown', 'datas'));
    }

    public function dashboard()
    {
       

        return view('guru.dashboardguru');
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

        $kode_guru = $request->kode_guru;
        $nama_guru = $request->nama_guru;
        $jk = $request->jk;
        $tgllahir = $request->tgllahir;
        $jabatan = $request->jabatan;
        $notelp = $request->notelp;
        $email = $request->email;
        $password = Hash::make($request->password);
        $role = $request->role;

        DB::beginTransaction();


        try {
            if ($request->hasFile('foto')) {
                $path_loc = $request->file('foto');
                $url = $path_loc->move('storage/foto_guru', $path_loc->hashName());
                $valueFoto = $url->getPath() . "/" . $url->getFilename();
            } else {
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
    public function show($id)
    {
        $id = decrypt($id);
        $dropdown['Jabatan'] = Dropdown::where('kategori', 'Jabatan')->orderBy('nilai', 'asc')->get();
        $dropdown['JK'] = Dropdown::where('kategori', 'JK')->orderBy('nilai', 'asc')->get();
        $dropdown['Role'] = Dropdown::where('kategori', 'Role')->orderBy('nilai', 'asc')->get();
        $dropdown['Hari'] = Dropdown::where('kategori', 'Hari')->orderBy('format', 'asc')->get();
        $dropdown['Mapel'] = Mapel::orderBy('nama_mapel','asc')->get();
        $schedules = Schedule::where('id_guru',$id)
        ->select(
            'schedules.*',
            'mapel.nama_mapel',
            'mapel.kelas',
            'mapel.jurusan',
        )
        ->leftJoin('mapel','schedules.id_mapel','mapel.id')
        ->orderBy('schedules.jam_mulai','asc')
        ->get();
        $data = Guru::where('guru.id', $id)
            ->select(
                'guru.*',
                'users.kode_guru',
                'users.email',
                'users.role',
            )
            ->leftJoin('users', 'guru.id', 'users.id_guru')
            ->first();

        // dd($data);
        return view('guru.detailguru', compact('data', 'dropdown','schedules'));
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
            "kode_guru" => 'required',
            "nama_guru" => 'required',
            "jk" => 'required',
            "tgllahir" => 'required',
            "jabatan" => 'required',
            "email" => 'required',
            "role" => 'required',
            "foto" => 'mimes:jpeg,jpg,png',

        ]);

        $kode_guru = $request->kode_guru;
        $nama_guru = $request->nama_guru;
        $jk = $request->jk;
        $tgllahir = $request->tgllahir;
        $jabatan = $request->jabatan;
        $notelp = $request->notelp;
        $email = $request->email;
        $password = Hash::make($request->password);
        $role = $request->role;

        DB::beginTransaction();

        try {
            if ($request->hasFile('foto')) {
                $path_loc = $request->file('foto');
                $url = $path_loc->move('storage/foto_guru', $path_loc->hashName());
                $valueFoto = $url->getPath() . "/" . $url->getFilename();
                //update ke Guru
                $updateGuru = Guru::where('id', $id)
                    ->update([
                        'kode_guru' => $kode_guru,
                        'nama_guru' => $nama_guru,
                        'jk' => $jk,
                        'tgllahir' => $tgllahir,
                        'jabatan' => $jabatan,
                        'notelp' => $notelp,
                        'foto' => $valueFoto,
                    ]);
            } else {
                //update ke Guru
                $updateGuru = Guru::where('id', $id)
                    ->update([
                        'kode_guru' => $kode_guru,
                        'nama_guru' => $nama_guru,
                        'jk' => $jk,
                        'tgllahir' => $tgllahir,
                        'jabatan' => $jabatan,
                        'notelp' => $notelp,
                    ]);
            }

            if ($password == '') {
                //update ke Users
                User::where('id_guru', $id)
                    ->update([
                        'name' => $nama_guru,
                        'email' => $email,
                        'kode_guru' => $kode_guru,
                        'role' => $role,
                    ]);
            } else {
                //update ke Users
                User::where('id_guru', $id)
                    ->update([
                        'name' => $nama_guru,
                        'email' => $email,
                        'kode_guru' => $kode_guru,
                        'password' => $password,
                        'role' => $role,
                    ]);
            }


            DB::commit();

            return redirect('/guru/show/' . encrypt($id))->with('success', 'Data berhasil diubah.');
        } catch (\Throwable $th) {
            //throw $th;

            DB::rollBack();
            return redirect('/guru/show/' . encrypt($id))->with('failed', 'Data Gagal diubah.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
        $id = decrypt($id);
        
        DB::beginTransaction();

        try{
            $hapusGuru = Guru::where('id', $id)
            ->update([
                'status' => '0'
            ]);
            $hapusUser = User::where('id_guru', $id)
            ->update([
                'status' => '0'
            ]);

            DB::commit();

            return redirect('/guru')->with('success', 'Guru berhasil dinonaktifkan');

        }catch (\Throwable $th) {
            //throw $th;

            DB::rollBack();
            return redirect('/guru')->with('failed', 'Guru gagal dinonaktifkan');
        }
        

    }
    public function active($id)
    {
        $id = decrypt($id);
        
        DB::beginTransaction();

        try{
            $hapusGuru = Guru::where('id', $id)
            ->update([
                'status' => '1'
            ]);
            $hapusUser = User::where('id_guru', $id)
            ->update([
                'status' => '1'
            ]);

            DB::commit();

            return redirect('/guru')->with('success', 'Guru berhasil diaktifkan');

        }catch (\Throwable $th) {
            //throw $th;

            DB::rollBack();
            return redirect('/guru')->with('failed', 'Guru gagal diaktifkan');
        }
        

    }
}
