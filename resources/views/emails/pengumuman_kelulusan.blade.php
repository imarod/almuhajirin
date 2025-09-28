<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengumuman Kelulusan</title>
</head>

<body style="font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 0;">

    <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color: #f4f4f4;">
        <tr>
            <td align="center" style="padding: 20px;">
                <table width="600" cellpadding="0" cellspacing="0" border="0"
                    style="background-color: #ffffff; border-radius: 8px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                    <tr>
                        <td align="center"
                            style="padding: 20px 0; border-top-left-radius: 8px; border-top-right-radius: 8px;">
                            <h1 style=" font-size: 24px; margin: 10px 0 0 0;">Pengumuman Hasil PPDB</h1>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 40px 30px;">
                            <h2 style="color: #333333; font-size: 20px; margin-bottom: 20px;">Halo,
                                {{ $pendaftaran->siswa->nama }}!</h2>

                            @if ($pendaftaran->status_aktual == 'Diterima')
                                <p style="color: #666666; font-size: 16px; line-height: 1.6; margin-bottom: 20px;">Selamat! Anda dinyatakan Diterima dalam pendaftaran PPDB. Silakan cek dashboard
                                    pendaftaran untuk melihat
                                    status pendaftaran.</p>
                            @else
                                <p style="color: #666666; font-size: 16px; line-height: 1.6; margin-bottom: 20px;">Mohon maaf, Anda dinyatakan Tidak Diterima dalam pendaftaran PPDB. Tetap
                                    semangat!</p>
                            @endif                            

                            <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                <tr>
                                    <td align="center" style="padding-top: 20px;">
                                        <a href="{{ route('login.token', ['token' => $token]) }}" target="_blank"
                                            style="display: inline-block; padding: 12px 24px; background-color: #007bff; color: #ffffff; text-decoration: none; border-radius: 5px; font-weight: bold;">
                                            Lihat Status Pendaftaran
                                        </a>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <tr>
                        <td align="center"
                            style="background-color: #f0f0f0; padding: 20px 30px; border-bottom-left-radius: 8px; border-bottom-right-radius: 8px;">
                            <p style="font-size: 12px; color: #999999; margin: 0;">
                                &copy; {{ date('Y') }} MAS Al Muhajirin. Semua Hak Cipta Dilindungi.
                            </p>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</body>

</html>

