<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keluar extends Model
{
    use HasFactory;
    protected $guarded = [""];

    public function kategori(){
       return $this->belongsTo(Kategori::class);
    }
    public function barang(){
       return $this->belongsTo(Barang::class);
    }

    public function scopeFilter($query, array $filter)
    {
        $query->when($filter['cari'] ?? false, function ($query, $cari) {
            return $query->where('nama', 'like', '%' . $cari . '%');
        });

        $query->when($filter['kategori'] ?? false, function ($query, $kategori) {
            return $query->whereHas("kategori", function ($query) use ($kategori) {
                $query->where("id", $kategori);
            });
        });

        $query->when($filter['tanggal_awal'] ?? false, function ($query, $tanggalAwal) {
            $query->whereDate('tanggal', '>=', $tanggalAwal);
        });
        
        $query->when($filter['tanggal_akhir'] ?? false, function ($query, $tanggalAkhir) {
            $query->whereDate('tanggal', '<=', $tanggalAkhir);
        });

        return $query;
    }
}
