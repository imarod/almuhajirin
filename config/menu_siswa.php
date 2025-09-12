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

      // Navbar items:
        [
            'type' => 'navbar-search',
            'text' => 'search',
            'topnav_right' => true,
        ],
        [
            'type' => 'fullscreen-widget',
            'topnav_right' => true,
        ],

        // Sidebar items:
        [
            'type' => 'sidebar-menu-search',
            'text' => 'search',
        ],
        [
            'text' => 'blog',
            'url' => 'admin/blog',
            'can' => 'manage-blog',
        ],
        [
            'text' => 'pages',
            'url' => 'admin/pages',
            'icon' => 'far fa-fw fa-file',
            'label' => 4,
            'label_color' => 'success',
        ],
        ['header' => 'account_settings'],
        [
            'text' => 'profilerhhrj',
            'url' => 'admin/settings',
            'icon' => 'fas fa-fw fa-user',
        ],
        [
            'text' => 'change_password',
            'url' => 'admin/settings',
            'icon' => 'fas fa-fw fa-lock',
        ],
];
