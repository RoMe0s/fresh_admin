<?php

use SleepingOwl\Admin\Navigation\Page;

return [
    [
        'title' => 'Dashboard',
        'icon'  => 'fa fa-dashboard',
        'url'   => route('admin.dashboard'),
        'priority' => 0
    ],
    [
        'title' => 'Контент',
        'icon' => 'fa fa-file',
        'priority' => 7,
        'pages' => [
            (new Page(\App\Models\Page::class))
                ->setIcon('fa fa-file')
                ->setPriority(1)
        ]
    ],
    [
        'title' => 'Доступы',
        'icon' => 'fa fa-group',
        'priority' => 100,
        'pages' => [
            (new Page(\App\Models\User::class))
                ->setIcon('fa fa-user')
                ->setPriority(1),
            (new Page(\Spatie\Permission\Models\Role::class))
                ->setIcon('fa fa-group')
                ->setPriority(2)
        ]
    ],
    [
        'title' => 'Выход',
        'priority' => 1000,
        'url' => '/logout'
    ]
];
