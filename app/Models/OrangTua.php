<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrangTua extends Model
{
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
