<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $transaksiIN = DB::table('transaksi')
                    ->where('code', 1)
                    ->sum('nominal');
        // $transaksiIN = DB::table('transaksi')->sum(COLUMN_NAME);
        $transaksiOUT = DB::table('transaksi')
                    ->where('code', 2)
                    ->sum('nominal');
        $saldo = $transaksiIN - $transaksiOUT;
        return view('index', compact('saldo', 'transaksiIN', 'transaksiOUT'));
    }

    public function Kategory()
    {
        $kategory = DB::table('kategory')
                    ->get();
        return view('kategory', compact('kategory'));
    }

    public function Transaksi()
    {
        $transaksi = DB::table('transaksi')
                    ->get();
        $transaksiIN = DB::table('transaksi')
                    ->where('code', 1)
                    ->sum('nominal');
        // $transaksiIN = DB::table('transaksi')->sum(COLUMN_NAME);
        $transaksiOUT = DB::table('transaksi')
                    ->where('code', 2)
                    ->sum('nominal');
        $saldo = $transaksiIN - $transaksiOUT;
        return view('transaksi', compact('transaksi', 'saldo', 'transaksiIN', 'transaksiOUT'));
    }
}
