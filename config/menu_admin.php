<?php

return [
    [
        'text' => 'Dashboard',
        'url'  => 'admin/dashboard-statistik',
        'icon' => 'fas fa-tachometer-alt',
    ],
    [
        'text' => 'Data Pendaftar',
        'url'  => 'admin/data-pendaftar',
        'icon' => 'fas fa-users',
    ],

     [
        'text' => 'Jadwal PPDB',
        'url'  => 'admin/manajemen-jadwal-ppdb',
        'icon' => 'fas fa-cog',
    ],
    
    [
        'text' => 'Manajemen User',
        'url'  => 'admin/manajemen-user',
        'icon' => 'fas fa-cog',
    ],
   
    // [
    //     'text' => 'Manajemen Jadwal PPDB',
    //     'url'  => 'admin/manajemen-jadwal-ppdb',
    //     'icon' => 'fas fa-cog',
    // ],
    // Tambah menu admin lainnya di sini...

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
