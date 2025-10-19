<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifikasi Pendaftaran</title>
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
                            <h1 style=" font-size: 24px; margin: 10px 0 0 0;">PPDB AL Muhajirin</h1>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 30px 30px;">
                            <h2 style="color: #333333; font-size: 20px; margin-bottom: 20px;">Halo,
                                {{ $pendaftaran->siswa->nama }}!</h2>

                            <p style="color: #666666; font-size: 16px; line-height: 1.6; margin-bottom: 20px;">
                                Terima kasih telah melakukan pendaftaran. Kami informasikan bahwa terdapat beberapa data
                                atau dokumen yang perlu diperbaiki atau dilengkapi agar proses pendaftaran dapat
                                dilanjutkan.
                            </p>

                            <p style="color: #666666; font-size: 16px; line-height: 1.6; margin-bottom: 20px;">
                               Harap perbaiki formulir sesuai catatan dan segera kirim kembali sebelum batas tanggal penutupan {{ \Carbon\Carbon::parse($pendaftaran->jadwal->tgl_berakhir)->format('d F Y') }}.
                            </p>

                            <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                <tr>
                                    <td align="center" style="padding-top: 20px;">
                                        <a href="{{ route('login.token', ['token' => $token]) }}" target="_blank"
                                            style="display: inline-block; padding: 12px 24px; background-color: #2E8B57; color: #ffffff; text-decoration: none; border-radius: 5px; font-weight: bold;">
                                            Lihat Catatan Perbaikan
                                        </a>
                                    </td>
                                </tr>
                            </table>

                            <br>

                             <p style="color: #666666; font-size: 16px; line-height: 1.6; margin-bottom: 20px;">
                               Terima Kasih
                               <br>
                                Panitia PPDB MAS Al Muhajirin
                            </p>
                        </td>
                    </tr>

                    {{-- <tr>
                        <td align="center"
                            style="background-color: #f0f0f0; padding: 20px 30px; border-bottom-left-radius: 8px; border-bottom-right-radius: 8px;">
                            <p style="font-size: 12px; color: #999999; margin: 0;">
                                &copy; {{ date('Y') }} MAS Al Muhajirin. Semua Hak Cipta Dilindungi.
                            </p>
                        </td>
                    </tr> --}}

                </table>
            </td>
        </tr>
    </table>

</body>

</html>
