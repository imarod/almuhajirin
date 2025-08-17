<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ManajemenJadwalPpdb;
use Carbon\Carbon;

class Pendaftaran extends Model
{
    protected $table = 'pendaftaran';
    protected $fillable = ['siswa_id','kk', 'ijazah', 'piagam', 'status_verifikasi','status_aktual','is_announced','pesan_whatsapp'];
    protected $casts = [
        'is_announced'=>'boolean',
        'pesan_whatsapp'=>'boolean',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
    public function showStatusPendaftar()
    {
        $jadwal = ManajemenJadwalPpdb::first();
        $tanggalPengumuman = $jadwal ? Carbon::parse($jadwal->tgl_pengumuman) : null;
        
        // Jika notifikasi sudah diumumkan (is_announced), tampilkan status aktual
        if ($this->is_announced && $tanggalPengumuman  && $tanggalPengumuman->isPast()) {
            return $this->status_aktual;
        }

        // Jika tanggal pengumuman sudah diatur tapi belum tiba, tampilkan 'Di proses'
        if ($tanggalPengumuman && $tanggalPengumuman->isFuture()) {
            return 'Di proses';
        }
        
        return $this->status_verifikasi;
    }
}
