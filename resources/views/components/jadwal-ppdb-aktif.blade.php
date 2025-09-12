@if($isRegistered && (request()->routeIs('formulir-siswa') || request()->routeIs('ajuan.pendaftaran')))
     <div class="card mb-4 border-left-success shadow-sm" style="border-left: 4px solid #28a745 !important;">
        <div class="card-body" style="background: linear-gradient(135deg, #d4edda 0%, #e8f5e9 100%);">
            <div class="d-flex align-items-center">
                <div class="flex-shrink-0 mr-3">
                    <div class="bg-success rounded-circle d-flex align-items-center justify-content-center"
                        style="width: 40px; height: 40px; background-color: rgba(40, 167, 69, 0.1) !important;">
                        <i class="fas fa-check text-success"></i>
                    </div>
                </div>
                <div>
                    <h5 class="font-weight-bold text-dark mb-1">{{$message}}</h5>
                    <p class="text-muted mb-0 small">
                        Pendaftaran Anda sedang diproses. Silakan cek status Anda secara berkala.
                    </p>
                </div>
            </div>
        </div>
    </div>


@elseif($jadwalAktif)
<div class="card mb-4 border-left-primary shadow-sm" style="border-left: 4px solid #5E7CE3 !important;">
    <div class="card-body" style="background: linear-gradient(135deg, #e3f2fd 0%, #e8eaf6 100%);">
        <div class="d-flex align-items-center">
            <div class="flex-shrink-0 mr-3">
                <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center"
                    style="width: 40px; height: 40px; background-color: rgba(0, 123, 255, 0.1) !important;">
                    <i class="fas fa-bell" style="color: #5E7CE3;"></i>
                </div>
            </div>
            <div>
                <h5 class="font-weight-bold text-dark mb-1">
                    Pendaftaran Tahun Ajaran {{ $jadwalAktif->thn_ajaran }} Gelombang
                    {{ $jadwalAktif->gelombang_pendaftaran }} Telah Dibuka
                </h5>
                <p class="text-muted mb-0 small">
                    Periode pendaftaran berlangsung hingga tanggal
                    {{ \Carbon\Carbon::parse($jadwalAktif->tgl_berakhir)->format('d-m-Y') }}
                </p>
            </div>
        </div> 
    </div>
</div>

@else
<div class="card mb-4 border-left-primary shadow-sm" style="border-left: 4px solid #ff0000 !important;">
    <div class="card-body" style="background: linear-gradient(135deg, #fde3e3 0%, #f6e8e8 100%);">
        <div class="d-flex align-items-center">
            <div class="flex-shrink-0 mr-3">
                <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center"
                    style="width: 40px; height: 40px; background-color: rgba(255, 25, 0, 0.1) !important;">
                    <i class="fas fa-bell text-danger"></i>
                </div>
            </div>
            <div>
                <h5 class="font-weight-bold text-dark mb-1">{{ $message }}</h5>
            </div>
        </div>
    </div>
</div>
@endif