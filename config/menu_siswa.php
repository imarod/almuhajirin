<?php

return [
    [
        'text' => 'Daftar',
        'url'  => 'siswa/pendaftaran',
        'icon' => 'fas fa-file-alt',
    ],
   
    [
        'text' => 'Cetak Bukti Pendaftaran',
        // 'url'  => 'cetak/formulir', 
        //ini contoh pemanggilan menggunakan route name
        'url'  => fn() => route('siswa.daftar-formulir'),
        'icon' => 'fas fa-user',
    ],
    [
        'text' => 'Profil Saya',
        'url'  => '/home',
        'icon' => 'fas fa-user',
    ],
    [
        'text' => 'Profil Saya',
        'url'  => '/home',
        'icon' => 'fas fa-user',
    ],
    [
        'text' => 'Profil Saya',
        'url'  => '/home',
        'icon' => 'fas fa-user',
    ],
    [
        'text' => 'Profil Saya',
        'url'  => '/home',
        'icon' => 'fas fa-user',
    ],
];
