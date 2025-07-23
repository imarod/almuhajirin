<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    protected $table = 'pendaftaran';
    protected $fillable = ['siswa_id','kk', 'ijazah', 'piagam', 'status_verifikasi'];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
}
