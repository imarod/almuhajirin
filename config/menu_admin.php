<?php

return [
    [
        'text' => 'Dashboard',
        'url'  => 'admin/dashboard-statistik',
        'icon' => 'fas fa-tachometer-alt',
    ],


    // [
    //     'text' => 'Manajemen Jadwal PPDB',
    //     'url'  => 'admin/manajemen-jadwal-ppdb',
    //     'icon' => 'fas fa-cog',
    // ],


    // Navbar items:

    [
        'type' => 'fullscreen-widget',
        'topnav_right' => true,
    ],

    // Sidebar items:
    // [
    //     'type' => 'sidebar-menu-search',
    //     'text' => 'search',
    // ],
    // [
    //     'text' => 'blog',
    //     'url' => 'admin/blog',
    //     'can' => 'manage-blog',
    // ],
    // [
    //     'text' => 'pages',
    //     'url' => 'admin/pages',
    //     'icon' => 'far fa-fw fa-file',
    //     'label' => 4,
    //     'label_color' => 'success',
    // ],
    // ['header' => 'account_settings'],

    [
        'text' => 'Data Pendaftar',
        'url'  => 'admin/data-pendaftar',
        'icon' => 'fas fa-users',
    ],

    [
        'text' => 'Manajemen PPDB',
        'icon' => 'fas fa-cog',
        'submenu' => [
            [
                'text' => 'Jadwal PPDB',
                'url'  => 'admin/manajemen-jadwal-ppdb',
            ],
            [
                'text' => 'Jurusan',
                'url' => 'admin/manajemen-jurusan',
            ],
            [
                'text' => 'Jalur Prestasi',
                'url' => 'admin/kategori-prestasi',
            ],
        ],
    ],

    [
        'text' => 'Manajemen User',
        'url'  => 'admin/manajemen-user',
        'icon' => 'fas fa-cog',
    ],

    

];
