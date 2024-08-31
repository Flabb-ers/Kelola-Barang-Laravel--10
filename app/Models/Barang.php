<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Barang extends Model
{
    use HasFactory;
    protected $guarded = ["id"];
    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
    protected $table = 'barangs';

    public function keluar()
    {
        return $this->hasMany(Keluar::class);
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
