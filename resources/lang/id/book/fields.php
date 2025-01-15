<?php

return [
    'page' => [
        'title' => 'Buku'
    ],
    'label' => [
        'title' => 'Judul',
        'slug' => 'Slug',
        'synopsis' => 'Sinopsis',
        'image' => [
            'upload' => [
                'label' => 'Gambar Sampul',
                'desc' => 'Unggah Gambar'
            ],
            'insert' => [
                'label' => 'URL Gambar',
                'desc' => 'Masukkan Tautan Gambar'
            ]
        ],
        'details' => [
            'label' => 'Detail',
            'lang' => [
                'label' => 'Bahasa',
                'desc' => 'Pilih Bahasa'
            ],
            'page_count' => [
                'label' => 'Jumlah Halaman',
                'desc' => 'Total jumlah halaman yang akan ditampilkan dalam buku ini. Nilai harus berupa bilangan bulat positif yang menunjukkan batas maksimum data yang dapat dibagi ke dalam beberapa halaman.'
            ]
        ],
        'status' => [
            'is_fiction' => [
                'title' => 'Fiksi',
                'label' => 'Tandai sebagai buku fiksi',
                'desc' => 'Buku ini akan ditandai sebagai buku fiksi.'
            ],
            'is_teachers_book' => [
                'title' => 'Buku Guru',
                'label' => 'Tandai sebagai buku guru',
                'desc' => 'Buku ini hanya akan bisa diakses oleh guru.'
            ],
            'release_date' => [
                'label' => 'Tanggal Rilis'
            ],
            'created_at' => [
                'label' => 'Tanggal Ditambahkan'
            ]
        ],
        'genres' => [
            'label' => 'Genre',
            'desc' => 'Pilih genre...'
        ],
        'author' => 'Penulis'
    ]
];
