<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class rating extends Model
{
   use HasFactory;
    protected $fillable = [
        'penjualan_id',
        'pelanggans_id',
        'rating',
        'ulasan',
    ];
    public function user(){
        return $this->hasMany(pelanggans::class, 'pelanggans_id', 'id');
    }
    public function penjualan(){
        return $this->hasMany(penjualan::class,'penjualans_id','id');
    }
}
