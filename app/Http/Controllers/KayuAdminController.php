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

class KayuAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kayu = DB::table('kayus')->get();
        return view('product.index',compact('kayu'));
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
            'imgkayu' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
        ]);
        $imageName = time().'.'.$request->imgkayu->extension();
        $request->imgkayu->move(public_path('images/products'), $imageName);
        // $adminId = $request->get('namaadmin');
        $data = new kayu();
        $data->nama_kayu = $request->get('namakayu');
        $data->deskripsi = $request->get('desckayu');
        $data->jumlah_kayu = $request->get('jumlahkayu');
        $data->harga_kayu = $request->get('hargakayu');
        // $data->users_id = $adminId;
        $data->foto_kayu = $imageName;
        $data->save();
        return redirect()->route('product.index')->with('status', 'horray!!,you success to insert wood');
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
        $request->validate([
        'imgkayu' => 'image|mimes:jpeg,png,jpg,svg|max:2048',
    ]);
    $objKayu = kayu::find($id);
    // $adminId = $request->get('namaadmin');

    if ($request->hasFile('imgkayu')) {
        $oldImagePath = public_path('images/products'.$objKayu->foto_kayu);
        if (File::exists($oldImagePath)) {
            File::delete($oldImagePath);
        }

        // Upload the new image
        $imageName = time().'.'.$request->imgkayu->extension();
        $request->imgport->move(public_path('images'), $imageName);
    } else {
        $imageName = $objKayu->foto_kayu;
    }

        $objKayu->nama_kayu = $request->get('namakayu');
        $objKayu->deskripsi = $request->get('desckayu');
        $objKayu->jumlah_kayu = $request->get('jumlahkayu');
        $objKayu->harga_kayu = $request->get('hargakayu');
        $objKayu->foto_kayu = $imageName;
        $objKayu->save();
        return redirect()->route('product.index')->with('status', 'horray!!,you success to update products');
    }
public function getEditForm(Request $request) {
    $id = $request->id;
    $data = kayu::find($id);
    return response()->json([
        'status' => 'ok',
        'msg' => view('product.getEditForm', compact('data'))->render()
    ]);
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
