@if($isRegistered)
    {{-- Blok untuk status Diterima, Ditolak, atau Diproses --}}
    @php
        $status; 
        $icon = '';
        $cardClass = '';
        $borderStyle = '';
        $bgStyle = '';
        $messageHeader = '';
        $messageBody = '';

        if ($status === 'Diterima' || $status === 'Ditolak') {
            $isAccepted = $status === 'Diterima';
            $icon = $isAccepted ? 'fas fa-check text-success' : 'fas fa-times text-danger';
            $color = $isAccepted ? '#28a745' : '#dc3545';
            $cardClass = $isAccepted ? 'border-left-success' : 'border-left-danger';
            $borderStyle = 'border-left: 4px solid ' . ($isAccepted ? '#28a745' : '#dc3545') . ' !important;';
            $bgStyle = 'background: linear-gradient(135deg, ' . ($isAccepted ? '#d4edda' : '#f8d7da') . ' 0%, #e8f5e9 100%);';
            $messageHeader = 'Pengumuman Hasil PPDB';
            $messageBody = $message;

        } elseif ($status === 'Diproses') {
            $icon = 'fas fa-user-clock';
            $color = '#17a2b8';
            $cardClass = 'border-left-info';
            $borderStyle = 'border-left: 4px solid #17a2b8 !important;';
            $bgStyle = 'background: linear-gradient(135deg, #d4f0f6 0%, #e8f5e9 100%);';
            $messageHeader = 'Pendaftaran Sedang Diproses';
            $messageBody = $message;

        } elseif ($status === 'Dikirim') {
            $icon = 'fas fa-envelope-open-text';
            $color = '#28a745';
            $cardClass = 'border-left-success';
            $borderStyle = 'border-left: 4px solid #28a745 !important;';
            $bgStyle = 'background: linear-gradient(135deg, #d4edda 0%, #e8f5e9 100%);';
            $messageHeader = 'Pendaftaran Berhasil Dikirim';
            $messageBody = $message;
        }
        
    @endphp

    <div class="card mb-4 {{ $cardClass }} shadow-sm" style="{{ $borderStyle }}">
        <div class="card-body" style="{{ $bgStyle }}">
            <div class="d-flex align-items-center">
                <div class="flex-shrink-0 mr-3">
                    <div class="rounded-circle d-flex align-items-center justify-content-center"
                        style="width: 40px; height: 40px; background-color: rgba(249, 250, 250, 0.1) !important;">
                        <i class="{{ $icon }}" style=" {{ $color }};"></i>
                    </div>
                </div>
                <div>
                    <h5 class="font-weight-bold text-dark mb-1">{{ $messageHeader }}</h5>
                    <p class="text-muted mb-0 small">{!! $messageBody !!}</p>
                </div>
            </div>
        </div>
    </div>
@elseif($jadwalAktif)
    {{-- Blok untuk jadwal aktif bagi non-pendaftar --}}
    <div class="card mb-4 border-left-primary shadow-sm" style="border-left: 4px solid #5E7CE3 !important;">
        <div class="card-body" style="background: linear-gradient(135deg, #e3f2fd 0%, #f6e8e8 100%);">
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
    {{-- Blok untuk pendaftaran tutup/belum dibuka --}}
    <div class="card mb-4 border-left-primary shadow-sm" style="border-left: 4px solid #ff0000 !important;">
        <div class="card-body" style="background: linear-gradient(135deg, #fde3e3 0%, #f6e8e8 100%);">
            <div class="d-flex align-items-center">
                <div class="flex-shrink-0 mr-3">
                    <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center"
                        style="width: 40px; height: 40px; background-color: rgba(255, 25, 0, 0.1) !important;">
                        <i class="fas fa-exclamation-triangle" style="color: #ff0000;"></i>
                    </div>
                </div>
                <div>
                    <h5 class="font-weight-bold text-dark mb-1">{{ $message }}</h5>
                    {{-- <p class="text-muted mb-0 small">
                       Silakan cek kembali jadwal pendaftaran.
                    </p> --}}
                </div>
            </div>
        </div>
    </div>
@endif