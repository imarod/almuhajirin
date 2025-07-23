<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Siswa;
use App\Models\OrangTua;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SiswaTest extends TestCase
{
    use RefreshDatabase;
    public function test_siswa_memiliki_orang_tua()
    {
        $orangTua = OrangTua::factory()->create();
        $siswa = Siswa::factory()->create([
            'orang_tua_id' => $orangTua->id
        ]);

        $this->assertInstanceOf(OrangTua::class, $siswa->orangTua);
    }
}
