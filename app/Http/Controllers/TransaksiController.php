<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    public function store(Request $request)
    {

        $transaksi = Transaksi::create([
            'code' => $request->code,
            'kategory' => $request->kategory,
            'nominal' => $request->nominal,
            'description' => $request->deskripsi,
        ]);

        return response()->json(['success' => true]);
    }

    public function show(Request $request)
    {
   
        $where = array('id' => $request->id);
        $hasil  = Transaksi::where($where)->first();

        return response()->json($hasil);

    }

    public function update(Request $request)
    {
        $transaksi   =   Transaksi::find($request->id);

        $transaksi->code = $request->code;
        $transaksi->kategory = $request->kategory;
        $transaksi->nominal = $request->nominal;
        $transaksi->description = $request->description;
        $transaksi->save();


        return response()->json(['success' => true]);
    }

    public function delete(Request $request)
    {
        $transaksi = Transaksi::find($request->id);

        $transaksi->delete();

        return response()->json(['success' => true]);
    }
}
