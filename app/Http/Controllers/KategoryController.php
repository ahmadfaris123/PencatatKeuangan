<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategory;
use Illuminate\Support\Facades\DB;

class KategoryController extends Controller
{
    public function store(Request $request)
    {


        $kategory = Kategory::create([
            'code_kategory' => $request->code,
            'nama' => $request->keterangan,
            'description' => $request->deskripsi,
        ]);

        return response()->json(['success' => true]);
    }

    public function show(Request $request)
    {
        $where = array('id' => $request->id);
        $hasil  = Kategory::where($where)->first();

        return response()->json($hasil);
    }

    public function change(Request $request)
    {

        // $hasil  = DB::table('kategory')
        //             ->where('code_kategory', $request->code_kategory)
        //             ->get();
        $hasil  = Kategory::select('nama')->where('code_kategory', $request->code_kategory)->get();

        return response()->json($hasil);
    }

    public function update(Request $request)
    {
        $kategory   =   Kategory::find($request->id);

        $kategory->code_kategory = $request->code;
        $kategory->nama = $request->keterangan;
        $kategory->description = $request->deskripsi;
        $kategory->save();


        return response()->json(['success' => true]);
    }

    public function delete(Request $request)
    {
        $kategory = Kategory::find($request->id);

        $kategory->delete();

        return response()->json(['success' => true]);
    }
}
