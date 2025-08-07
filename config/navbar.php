<?php

return [
    [
        'title' => 'Beranda',
        'show' => true,
        'route-name' => 'beranda',
        'is-active' => 'beranda',
        'permission' => null,
    ],
    [
        'title' => 'Profil',
        'show' => true,
        'route-name' => 'profil.sejarah',
        'is-active' => 'profil*',
        'permission' => null,
        'sub-menus' => [
            [
                'title' => 'Sejarah',
                'show' => true,
                'route-name' => 'profil.sejarah',
                'is-active' => 'profil.sejarah',
                'permission' => null,
            ],

            [
                'title' => 'Tujuan',
                'show' => true,
                'route-name' => 'profil.tujuan',
                'is-active' => 'profil.tujuan',
                'permission' => null,
            ],

            [
                'title' => 'Makna Logo',
                'show' => true,
                'route-name' => 'profil.logo-meaning',
                'is-active' => 'profil.logo-meaning',
                'permission' => null,
            ],
            [
                'title' => 'Visi Misi',
                'show' => true,
                'route-name' => 'profil.visi-misi',
                'is-active' => 'profil.visi-misi',
                'permission' => null,
            ],
            [
                'title' => 'Struktur Organisasi',
                'show' => true,
                'route-name' => 'profil.struktur-organisasi',
                'is-active' => 'profil.struktur-organisasi',
                'permission' => null,
            ],
        ],
    ],
    [
        'title' => 'Berita',
        'show' => true,
        'route-name' => 'berita',
        'is-active' => 'berita',
        'permission' => null,
    ],
    [
        'title' => 'Program',
        'show' => true,
        'route-name' => 'program',
        'is-active' => 'program',
        'permission' => null,
    ],
    [
        'title' => 'Pendaftaran Siswa',
        'show' => true,
        'route-name' => 'ppdb.informasi',
        'is-active' => 'ppdb.informasi',
        'permission' => null,
    ],
];
