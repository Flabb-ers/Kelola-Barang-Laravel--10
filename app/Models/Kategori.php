<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;
    protected $fillable = ["nama"];

    public function barang(){
        return $this->hasMany(Barang::class);
    }
    public function keluar(){
        return $this->hasMany(Keluar::class);
    }
}
