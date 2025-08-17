<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Testing\Fluent\Concerns\Has;

class ManajemenJadwalPpdb extends Model
{
    use HasFactory;

    protected $table = 'jadwal_ppdb';
    protected $fillable = ['tgl_pengumuman', 'thn_ajaran', 'gelombang_pendaftaran', 'kuota', 'tgl_mulai', 'tgl_berakhir'];
    protected $casts = [
        'tgl_mulai' => 'date',
        'tgl_berakhir' => 'date',
        'tgl_pengumuman' => 'date',
    ];
    public function getStatusAttribute()
    {
        $today = Carbon::today();

        if ($this->tgl_mulai > $today) {
            return 'Belum Dimulai';
        } elseif ($this->tgl_berakhir < $today) {
            return 'Selesai';
        } else {
            return 'Aktif';
        }
    }
}
