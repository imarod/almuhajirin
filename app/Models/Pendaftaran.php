<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ManajemenJadwalPpdb;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pendaftaran extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'pendaftaran';
    protected $fillable = [
        'siswa_id',
        'jadwal_id',
        'kk',
        'ijazah',
        'jurusan_id',
        'kategori_prestasi_id',
        'piagam',
        'status_verifikasi',
        'status_aktual',
        'is_announced',
        'pesan_whatsapp',
        'catatan'
    ];
    protected $casts = [
        'is_announced' => 'boolean',
        'pesan_whatsapp' => 'boolean',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function jadwal()
    {
        return $this->belongsTo(ManajemenJadwalPpdb::class, 'jadwal_id');
    }

    public function kategoriPrestasi()
    {
        return $this->belongsTo(KategoriPrestasi::class, 'kategori_prestasi_id');
    }

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'jurusan_id');
    }

    public function showStatusPendaftar()
    {
        $jadwal = ManajemenJadwalPpdb::first();
        $tanggalPengumuman = $jadwal ? Carbon::parse($jadwal->tgl_pengumuman) : null;

        // if ($tanggalPengumuman  && $tanggalPengumuman->isPast()) {
        //     return $this->status_aktual;
        // }
        if ($this->pesan_email && $tanggalPengumuman  && $tanggalPengumuman->isPast()) {
            return $this->status_aktual;
        }

        if ($this->status_verifikasi === 'Perbaikan') {
            return $this->status_verifikasi;
        }

        if ($this->status_aktual !== null) {
            return 'Diproses';
        }

        return $this->status_verifikasi;
    }
}
