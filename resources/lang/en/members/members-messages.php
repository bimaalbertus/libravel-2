<?php

return [
    'page' => [
        'title' => 'Users Messages',
        'nav_group' => 'User Management',
    ],
    'fields' => [
        'type' => [
            'label' => 'Type',
            'options' => [
                'delete_account' => 'Delete Account',
                'change_username' => 'Change Username',
                'other' => 'Other'
            ]
        ],
        'reason' => 'Reason',
        'requested_value' => 'Requested Change',
        'status' => [
            'label' => 'Status',
            'pending' => 'Pending',
            'approved' => 'Approved',
            'rejected' => 'Rejected'
        ],
        'created_at' => 'Created At'
    ],
    'actions' => [
        'approve' => [
            'label' => 'Approve',
            'message' => 'Account deleted.'
        ],
        'reject' => [
            'label' => 'Reject',
        ]
    ]
];
