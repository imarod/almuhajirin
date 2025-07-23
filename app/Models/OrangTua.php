<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Testing\Fluent\Concerns\Has;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrangTua extends Model
{
    use HasFactory;
    protected $table = 'orang_tua';

    protected $fillable = [
        'nama_ayah',
        'nama_ibu',
        'alamat_ortu',
        'no_hp_ortu',
    ];

    public function siswa()
    {
        return $this->hasMany(Siswa::class);
    }
}
