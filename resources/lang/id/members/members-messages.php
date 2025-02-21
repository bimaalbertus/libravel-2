<?php

return [
    'page' => [
        'title' => 'Pesan Pengguna',
        'nav_group' => 'Manajemen Pengguna',
    ],
    'fields' => [
        'type' => [
            'label' => 'Tipe',
            'options' => [
                'delete_account' => 'Hapus Akun',
                'change_username' => 'Ubah Nama Pengguna',
                'other' => 'Lainnya'
            ]
        ],
        'reason' => 'Alasan',
        'requested_value' => 'Perubahan yang Diminta',
        'status' => [
            'label' => 'Status',
            'pending' => 'Menunggu',
            'approved' => 'Disetujui',
            'rejected' => 'Ditolak'
        ],
        'created_at' => 'Dibuat Pada'
    ],
    'actions' => [
        'approve' => [
            'label' => 'Setujui',
            'message' => 'Akun dihapus.'
        ],
        'reject' => [
            'label' => 'Tolak',
        ]
    ]
];
