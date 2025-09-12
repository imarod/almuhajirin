<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class ManajemenJadwalPpdb extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'jadwal_ppdb';
    protected $fillable = ['tgl_pengumuman', 'thn_ajaran', 'gelombang_pendaftaran', 'kuota', 'tgl_mulai', 'tgl_berakhir', 'deleted_at'];
    protected $casts = [
        'tgl_mulai' => 'date',
        'tgl_berakhir' => 'date',
        'tgl_pengumuman' => 'date',
    ];

    public function pendaftaran()
    {
        return $this->hasMany(Pendaftaran::class, 'jadwal_id');
    }

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
    public function scopeActive(Builder $query) : Builder
    {
        $today = Carbon::today();
        return $query->where('tgl_mulai', '<=', $today)
                     ->where('tgl_berakhir', '>=', $today);
    }
    public function scopeOverlapse(Builder $query, $start, $end, $exceptId = null): Builder
    {
        $query->where(function($q) use ($start, $end){
            $q->whereBetween('tgl_mulai', [$start, $end])
            ->orWhereBetween('tgl_berakhir', [$start, $end])
            ->orWhere(function ($q2) use($start, $end) {
                $q2->where('tgl_mulai', '<', $start)
                ->where('tgl_berakhir', '>', $end);
            });
        })
        ->whereNull('deleted_at');
        
        if($exceptId) {
            $query->where('id', '!=', $exceptId);
        }
        return $query;
    }
}
