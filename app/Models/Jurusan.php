<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Jurusan extends Model
{
   use HasFactory, SoftDeletes;

   protected $table = 'jurusan';

   protected $fillable = [
    'nama_jurusan',
    'is_active',
   ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

     public function pendaftarans()
    {
        return $this->hasMany(Pendaftaran::class, 'jurusan_id');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
