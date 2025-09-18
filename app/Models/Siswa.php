<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Siswa extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'siswa';
    protected $fillable = [
        'user_id','orang_tua_id', 'nama','tempat_lahir', 'tanggal_lahir', 'jenis_kelamin', 'nisn', 'alamat_siswa', 'no_hp_siswa','email_siswa', 'kategori_prestasi'
    ];
      protected $casts = [
        'tanggal_lahir' => 'date',
    ];

    public function orangTua() 
    {
        return $this->belongsTo(OrangTua::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function pendaftaran()
    {
        return $this->hasOne(Pendaftaran::class);
    }
}
