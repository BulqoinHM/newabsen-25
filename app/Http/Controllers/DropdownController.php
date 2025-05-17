<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Dropdown;

class DropdownController extends Controller
{
    public function index()
    {
        $datas = Dropdown::get();
        return view('dropdown.index-drop', compact('datas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            "kategori" => 'required',
            "nilai" => 'required',
            "format" => 'required',


        ]);

        $kategori = $request->kategori;
        $nilai = $request->nilai;
        $format = $request->format;

        DB::beginTransaction();


        try {
            //store ke Dropdowns
            Dropdown::create([
                'kategori' => $kategori,
                'nilai' => $nilai,
                'format' => $format,

            ]);

            DB::commit();

            return redirect('/dropdown')->with('success', 'Data berhasil ditambahkan.');
        } catch (\Throwable $th) {
            //throw $th;
      
            DB::rollBack();
            return redirect('/dropdown')->with('failed', 'Data Gagal ditambahkan.');
        }
    }

    public function update(Request $request, $id)
    {
        $id = decrypt($id);

        $request->validate([
            "kategori" => 'required',
            "nilai" => 'required',
            "format" => 'required',

        ]);

        $kategori = $request->kategori;
        $nilai = $request->nilai;
        $format = $request->format;

        DB::beginTransaction();

        try {
            Dropdown::where('id', $id)
                ->update([
                    'kategori' => $kategori,
                    'nilai' => $nilai,
                    'format' => $format,
                ]);
            DB::commit();

            return redirect('/dropdown')->with('success', 'Data berhasil diubah.');
        } catch (\Throwable $th) {
            //throw $th;

            DB::rollBack();
            return redirect('/dropdown')->with('failed', 'Data Gagal diubah.');
        }
    }

    public function delete($id)
    {
        $id = decrypt($id);

        $count = Dropdown::where('id', $id)->count();

        if ($count > 0) {
            DB::beginTransaction();

            try {
                $dropdown = Dropdown::find($id);
                $dropdown->delete();

                DB::commit();

                return redirect('dropdown')->with('success', 'Data Berhasil Dihapus!!!!');
            } catch (\Throwable $th) {
                //throw $th;
                DB::rollBack();
                return redirect()->back();
            }
        }
    }
}
