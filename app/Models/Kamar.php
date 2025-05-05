<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kamar extends Model
{
    use HasFactory;
    protected $table = 'kamars';
    protected $guarded =['id'];

    public function pemesanan (){
        return $this -> HasMany(Pemesanan::class);
    }
}
