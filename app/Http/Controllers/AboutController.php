<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\about;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $about = DB::table('abouts')->get();
       return view('about.index',compact('about')
    );
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
       $objCategory = about::find($id);
        // $adminId = $request->get('namaadmin');
        $objCategory->visi = $request->get('visi');
        $objCategory->misi = $request->get('misi');
        $objCategory->deskripsi = $request->get('desc');
        // $objCategory->users_id = $adminId;
        $objCategory->save();
        return redirect()->route('about.index')->with('status', 'horray!!,you success to update ');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
     public function getEditForm(Request $request){
        $id = $request->get('id');
        $data = about::find($id);
        return response()->json(array(
            'status'=>'oke',
            'msg' => view('about.getEditForm',compact('data'))->render()
        ));
    }
}
