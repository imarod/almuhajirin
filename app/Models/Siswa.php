<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Siswa extends Model
{
    use HasFactory;
    protected $table = 'siswa';
    protected $fillable = [
        'orang_tua_id', 'nama','tempat_lahir', 'tanggal_lahir', 'jenis_kelamin', 'nisn', 'alamat_siswa', 'no_hp_siswa', 'kategori_prestasi'
    ];

    public function orangTua() 
    {
        return $this->belongsTo(OrangTua::class);
    }
    public function pendaftaran()
    {
        return $this->hasOne(Pendaftaran::class);
    }
}
