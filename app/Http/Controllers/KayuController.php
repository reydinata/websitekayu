<?php

namespace App\Http\Controllers;

use App\Models\kayu;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class KayuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kayu = DB::table('kayus')->get();
        return view('customerpage.product.index',compact('kayu'));
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
    }

    /**
     * Display the specified resource.
     */

    public function show($id)
    { $kayu = DB::table('kayus')->get() ;
      $kayuDetail = DB::table('kayus')
    ->where('id', $id)
    ->first();
;
     return view('customerpage.product.detailproduct', compact('kayuDetail','kayu'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(kayu $kayu)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, kayu $kayu)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(kayu $kayu)
    {
        //
    }
}
