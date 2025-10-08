<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KategoriPrestasi extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'kategori_prestasi';

    protected $fillable = [
        'nama_prestasi',
        'deskripsi',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function pendaftarans()
    {
        return $this->hasMany(Pendaftaran::class, 'kategori_prestasi_id');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
