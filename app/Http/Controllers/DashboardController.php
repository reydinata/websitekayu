<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class DashboardController extends Controller
{

    public function index(Request $request)
    {  $bulan = $request->get('bulan', date('m'));
    $tahun = $request->get('tahun', date('Y'));

    // Ambil penjualan per tanggal
    $penjualanHarian = DB::table('penjualans')
        ->select(DB::raw('DATE(created_at) as tanggal'), DB::raw('count(*) as jumlah'))
        ->whereMonth('created_at', $bulan)
        ->whereYear('created_at', $tahun)
        ->groupBy(DB::raw('DATE(created_at)'))
        ->orderBy('tanggal')
        ->get();

    // Format data untuk chart
    $labels = $penjualanHarian->pluck('tanggal')->toArray();
    $values = $penjualanHarian->pluck('jumlah')->toArray();

        $ratings = DB::table('ratings')->pluck('rating'); // ambil hanya kolom rating
    $total = $ratings->count();

    // Hitung jumlah masing-masing rating
    $counts = [];
    for ($i = 5; $i >= 1; $i--) {
        $counts[$i] = $ratings->filter(fn($r) => $r == $i)->count();
    }

    $average = $total > 0 ? number_format($ratings->avg(), 1) : 0;

  $topKayu = DB::table('penjualans')
        ->join('kayus', 'penjualans.kayu_id', '=', 'kayus.id')
        ->select('kayus.nama_kayu', DB::raw('SUM(penjualans.jumlah_beli) as total_terjual'))
        ->groupBy('kayus.nama_kayu')
        ->orderByDesc('total_terjual')
        ->limit(3)
        ->get();
    return view('dashboard.index', compact('labels', 'values', 'counts', 'total', 'average', 'bulan', 'tahun','topKayu'));
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
