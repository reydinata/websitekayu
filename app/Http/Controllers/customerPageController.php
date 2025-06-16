<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\kayu;
use Illuminate\Support\Facades\Auth;
use App\Models\penjualan;
use App\Models\rating;
class customerPageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kayu = DB::table('kayus as k')
    ->join('penjualans as p', 'p.kayu_id', '=', 'k.id')
    ->select('k.nama_kayu','k.id','k.foto_kayu', 'k.deskripsi',DB::raw('SUM(p.jumlah_beli) as totalPenjualan'))
    ->groupBy('k.id', 'k.nama_kayu','k.deskripsi','k.foto_kayu')
    ->orderBy('totalPenjualan', 'asc')
    ->limit(3)
    ->get();
    $about = DB::table('abouts')->get();
    $rating = DB::table('ratings as r')
    ->join('pelanggans as p','r.pelanggans_id','p.id')
    ->select('p.nama_pelanggan','r.rating','r.ulasan')
    ->where('r.rating',5)
    ->get();
 return view('customerpage.index',compact('kayu','about','rating'));
    }

public function showListPembelian()
{
    $pelangganId = Auth::guard('pelanggans')->user()->id;
$metodePembayaran = DB::table('pembayarans')->get();
    $penjualans = DB::table('penjualans as pj')
        ->join('kayus as k', 'k.id', '=', 'pj.kayu_id')
        ->join('pelanggans as p', 'p.id', '=', 'pj.pelanggans_id')
        ->leftJoin('ratings as r', 'pj.id', '=', 'r.penjualan_id')
        ->select(
            'pj.id',
            'pj.kode_penjualan',
            'k.nama_kayu',
            'pj.jumlah_beli',
            'pj.total',
            'k.harga_kayu',
            'pj.status',
            'pj.created_at',
            'pj.updated_at',
            'pj.pembayarans_id',
            'pj.bukti_pembayaran',
            DB::raw('CASE WHEN r.id IS NULL THEN 0 ELSE 1 END as sudah_dirating')
        )
        ->where('p.id', $pelangganId)
        ->get();

    return view('customerpage.product.daftarpembelian', compact('penjualans','metodePembayaran'));
}

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
   public function store(Request $request)
{
    // Validasi input
    $request->validate([
        'kayu_id' => 'required|exists:kayus,id',
        'pelanggans_id' => 'required|exists:pelanggans,id',
        'jumlah_beli' => 'required|integer|min:1',
    ]);

    // Ambil data kayu
    $kayu = Kayu::findOrFail($request->kayu_id);
    $harga = $kayu->harga_kayu;

    // Cek apakah stok cukup
    if ($kayu->jumlah_kayu < $request->jumlah_beli) {
        return redirect()->back()->with('error', 'Stok kayu tidak mencukupi.');
    }

    // Hitung total pembelian
    $total = $harga * $request->jumlah_beli;

    // Simpan ke tabel penjualans
    $penjualan = new penjualan();
    $penjualan->kayu_id = $request->kayu_id;
    $penjualan->pelanggans_id = $request->pelanggans_id;
    $penjualan->jumlah_beli = $request->jumlah_beli;
    $penjualan->total = $total;
    $penjualan->status = 'proses';
    $penjualan->save();

    // Update stok kayu
    $kayu->jumlah_kayu -= $request->jumlah_beli;
    $kayu->save();

    return redirect()->back()->with('status', 'Pembelian berhasil diproses!');
}
public function updatePembayaran(Request $request)
{
    $request->validate([
        'penjualan_id' => 'required|exists:penjualans,id',
        'pembayarans_id' => 'required|exists:pembayarans,id',
        'bukti_pembayaran' => 'required|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $penjualan = penjualan::findOrFail($request->penjualan_id);

    $file = $request->file('bukti_pembayaran');
    $filename = time() . '_' . $file->getClientOriginalName();
    $file->move(public_path('images/bukti'), $filename);

    $penjualan->pembayarans_id = $request->pembayarans_id;
    $penjualan->bukti_pembayaran = $filename;
    $penjualan->save();

    return redirect()->back()->with('status', 'Bukti pembayaran berhasil dikirim!');
}
public function rating(Request $request)
{
    // Validasi input dari form
    $request->validate([
        'penjualan_id' => 'required|exists:penjualans,id',
        'rating' => 'required|integer|min:1|max:5',
        'ulasan' => 'required|string|max:255',
    ]);

    $penjualanId = $request->penjualan_id;
    $pelangganId = Auth::guard('pelanggans')->user()->id;

    // Cek apakah penjualan dimiliki oleh pelanggan yang login
    $penjualan = penjualan::where('id', $penjualanId)
        ->where('pelanggans_id', $pelangganId)
        ->first();

    if (!$penjualan) {
        return redirect()->back()->with('error', 'Data tidak valid atau tidak ditemukan.');
    }

    // Cek apakah sudah pernah dirating
    $alreadyRated = Rating::where('penjualan_id', $penjualanId)->exists();
    if ($alreadyRated) {
        return redirect()->back()->with('error', 'Penjualan ini sudah diberi rating sebelumnya.');
    }

    // Simpan rating
    Rating::create([
        'penjualan_id' => $penjualanId,
        'pelanggans_id' => $pelangganId,
        'rating' => $request->rating,
        'ulasan' => $request->ulasan,
    ]);

    return redirect()->back()->with('success', 'Rating berhasil dikirim!');
}


    public function getInputForm(Request $request){

        $id = $request->get('id');
        $data = kayu::find($id);
        return response()->json(array(
            'status'=>'oke',
            'msg' => view('customerpage.product.getInputForm',compact('data'))->render()
        ));

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
