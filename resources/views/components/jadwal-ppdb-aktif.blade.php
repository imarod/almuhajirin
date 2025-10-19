@if ($isRegistered)
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
            $icon = $isAccepted ? 'fas fa-check-double' : 'fas fa-exclamation text-danger';
            $color = $isAccepted ? '#28a745' : '#dc3545';
            $cardClass = $isAccepted ? 'border-left-success' : 'border-left-danger';
            $borderStyle = 'border-left: 4px solid ' . ($isAccepted ? '#28a745' : '#dc3545') . ' !important;';
            $bgStyle = 'background: ' . ($isAccepted ? '#d4edda' : '#f8d7da') . ';';
            $messageHeader = 'Pengumuman Hasil PPDB';
            $messageBody = $message;
        } elseif ($status === 'Diproses') {
            $icon = 'fas fa-sync-alt';
            $color = '#5E7CE3';
            $cardClass = 'border-left-info';
            $borderStyle = 'border-left: 4px solid #5E7CE3 !important;';
            $bgStyle = 'background: rgba(94, 124, 227, 0.25);';
            $messageHeader = 'Pendaftaran Sedang Diproses';
            $messageBody = $message;
        } elseif ($status === 'Perbaikan') {
            $icon = 'fas fa-pen';
            $color = '#eda73d';
            $cardClass = 'border-left-info';
            $borderStyle = 'border-left: 4px solid #eda73d !important;';
            $bgStyle = 'background: #fff3cd;';
            $messageHeader = 'Formulir Perlu Diperbaiki';
            $messageBody = $message;
        } elseif ($status === 'Dikirim') {
            $icon = 'fas fa-check';
            $color = '#eda73d';
            $cardClass = 'border-left-success';
            $borderStyle = 'border-left: 4px solid #eda73d !important;';
            $bgStyle = 'background: #fff3cd;';
            $messageHeader = 'Pendaftaran Berhasil Dikirim';
            $messageBody = $message;
        }

    @endphp

    <div class="card mb-4 {{ $cardClass }} shadow-sm" style="{{ $borderStyle }}">
        <div class="card-body" style="{{ $bgStyle }}">
            <div class="d-flex align-items-center">
                <div class="flex-shrink-0 mr-3">
                    <div class="rounded-circle d-flex align-items-center justify-content-center"
                        style="width: 40px; height: 40px; background-color: rgb(255, 255, 255) !important;">
                        <i class="{{ $icon }}" style="color: {{ $color }};"></i>
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
                        {{ \Carbon\Carbon::parse($jadwalAktif->tgl_berakhir)->format('d F Y') }}
                    </p>
                </div>
            </div>
        </div>
    </div>
@else
    {{-- Blok untuk pendaftaran tutup/belum dibuka --}}
    <div class="card mb-4 border-left-primary shadow-sm" style="border-left: 4px solid #ff0000 !important;">
        <div class="card-body" style="background: rgba(255, 0, 0, 0.15);">
            <div class="d-flex align-items-center">
                <div class="flex-shrink-0 mr-3">
                    <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center"
                        style="width: 40px; height: 40px; background-color: rgb(255, 255, 255) !important;">
                        <i class="fas fa-exclamation" style="color: #ff0000;"></i>
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
