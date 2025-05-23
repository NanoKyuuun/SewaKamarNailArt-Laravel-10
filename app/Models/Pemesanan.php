<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    use HasFactory;
    protected $table = 'pemesanans';
    protected $guarded = ['id'];
    public function kamar(){
        return $this -> belongsTo(Kamar::class);
    }
    public function pembayaran(){
        return $this -> hasOne(Pembayaran::class);
    }
}
