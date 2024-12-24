<?php

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/staff', function () {
    return view('staff', [
        'jobs' => [
            [
                'id' => 1,
                'title' => 'Director',
                'salary' => '$50,000'
            ],
            [
                'id' => 2,
                'title' => 'Programmer',
                'salary' => '$10,000'
            ],
            [
                'id' => 3,
                'title' => 'Teacher',
                'salary' => '$40,000'
            ]
        ]
    ]);
});

Route::get('/jobs/{id}', function ($id) {
    $jobs = [
        [
            'id' => 1,
            'title' => 'Director',
            'salary' => '$50,000'
        ],
        [
            'id' => 2,
            'title' => 'Programmer',
            'salary' => '$10,000'
        ],
        [
            'id' => 3,
            'title' => 'Teacher',
            'salary' => '$40,000'
        ]
    ];

    $job = Arr::first($jobs, fn($job) => $job['id'] == $id);

    return view('staff', ['job' => $job]);
});

Route::get('/courses', function () {
    return view('courses');
});

Route::get('/departments', function () {
    return view('departments');
});


Route::get('/students', function () {
    $jobs = [
        ['id' => 1, 'title' => 'Software Engineer', 'salary' => '70,000'],
        ['id' => 2, 'title' => 'Data Scientist', 'salary' => '80,000'],
        // Add more job listings as needed
    ];

    return view('students', ['jobs' => $jobs]);
});