<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class penjualan extends Model
{
    use HasFactory;
    public function user(){
        return $this->hasMany(pelanggans::class, 'pelanggans_id', 'idpelanggans');
    }
    public function kayu(){
        return $this->hasMany(kayu::class,'kayu_id','idkayu');
    }
}
