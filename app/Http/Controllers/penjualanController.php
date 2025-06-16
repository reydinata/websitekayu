<?php

namespace App\Http\Controllers;

use App\Models\penjualan;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
class penjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $penjualans = DB::table('penjualans as pj')
    ->join('kayus as k', 'k.id', '=', 'pj.kayu_id')
    ->join('pelanggans as p', 'p.id', '=', 'pj.pelanggans_id')
    ->select('k.nama_kayu','pj.id', 'pj.kode_penjualan', 'pj.bukti_pembayaran' ,'pj.jumlah_beli', 'pj.total', 'k.harga_kayu','pj.status','pj.created_at','pj.updated_at')
    ->get();
 return view('penjualan.index',compact('penjualans'));
    }
public function updateStatus($id)
{
    $penjualan = penjualan::findOrFail($id);

    if ($penjualan->status !== 'selesai') {
        $penjualan->status = 'selesai';
        $penjualan->save();
    }

    return redirect()->back()->with('status', 'Status penjualan berhasil diperbarui.');
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
    public function show(penjualan $penjualan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(penjualan $penjualan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, penjualan $penjualan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(penjualan $penjualan)
    {
        //
    }
}
