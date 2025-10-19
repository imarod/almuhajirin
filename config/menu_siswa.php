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
 

      // Navbar items:
      
        [
            'type' => 'fullscreen-widget',
            'topnav_right' => true,
        ],

        // Sidebar items:
        
];
