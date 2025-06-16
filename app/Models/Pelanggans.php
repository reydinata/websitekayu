<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Pelanggans extends Authenticatable
{
     use HasFactory, Notifiable;
 protected $guard = 'pelanggans';
    protected $fillable = ['nama_pelanggan', 'email_pelanggan', 'password', 'telepon_pelanggan'];
      protected $table = 'pelanggans';

    public function getAuthIdentifierName()
    {
        return 'email_pelanggan';
    }

}
