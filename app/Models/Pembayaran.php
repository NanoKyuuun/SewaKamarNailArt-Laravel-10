<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;
    protected $table = 'pembayarans';
    protected $guarded = ['id'];

    public function pemesanan(){
        return $this -> hasOne(Pemesanan::class);
    }
}
