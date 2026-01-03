<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Pendaftaran;
use App\Models\Siswa;
use App\Models\OrangTua;
use App\Models\Users;
use Illuminate\Http\UploadedFile;
use Mockery;
use Mockery\MockInterface;
class RegistrationRelationalTest extends TestCase
{
    /**
     * A basic unit test example.
     */

    protected $siswaModel;
    protected $orangTuaModel;
    protected $pendaftaranModel;

    public function __construct(Siswa $siswaModel, OrangTua $orangTuaModel, Pendaftaran $pendaftaranModel)
    {
       
        $this->siswaModel = $siswaModel;
        $this->orangTuaModel = $orangTuaModel;
        $this->pendaftaranModel = $pendaftaranModel;
    }

    public function test_example(): void
    {
        $this->assertTrue(true);
    }
}
