<?php

return [
    'page' => [
        'title' => 'Book'
    ],
    'label' => [
        'title' => 'Title',
        'slug' => 'Slug',
        'synopsis' => 'Synopsis',
        'image' => [
            'upload' => [
                'label' => 'Cover Image',
                'desc' => 'Upload Image'
            ],
            'insert' => [
                'label' => 'Image URL',
                'desc' => 'Insert Image Link'
            ]
        ],
        'details' => [
            'label' => 'Details',
            'lang' => [
                'label' => 'Language',
                'desc' => 'Select a Language'
            ],
            'page_count' => [
                'label' => 'Page Count',
                'desc' => 'The total number of pages to be displayed in this book. The value must be a positive integer indicating the maximum limit of data that can be divided into multiple pages.'
            ]
        ],
        'status' => [
            'is_fiction' => [
                'title' => 'Fiction',
                'label' => 'Mark as fiction book',
                'desc' => 'This book will marked as a fiction book.'
            ],
            'is_teachers_book' => [
                'title' => 'Teacher\'s Book',
                'label' => 'Mark as a teacher\'s book',
                'desc' => 'This book will be accessible for teachers only.'
            ],
            'release_date' => [
                'label' => 'Release Date'
            ],
            'created_at' => [
                'label' => 'Added Date'
            ]
        ],
        'genres' => [
            'label' => 'Genres',
            'desc' => 'Select genres...'
        ],
        'author' => 'Author'
    ]
];
