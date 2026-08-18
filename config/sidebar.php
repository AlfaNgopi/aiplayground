<?php

return [
    [
        'title' => 'Dashboard',
        'icon' => 'fas-house',
        'route' => 'dashboard',
        'active' => 'dashboard*',
        'permission' => null, // Bebas diakses semua user terautentikasi
    ],
    [
        'title' => 'User Management',
        'icon' => 'fas-users',
        'active' => ['users*', 'roles*', 'permissions*'],
        'permission' => ['view-users', 'view-roles', 'view-permissions'], // Parent muncul jika punya salah satu
        'children' => [
            [
                'title' => 'Users',
                'icon' => 'fas-user',
                'route' => 'users.index',
                'active' => 'users*',
                'permission' => 'view-users',
            ],
            [
                'title' => 'Roles',
                'icon' => 'fas-shield',
                'route' => 'roles.index',
                'active' => 'roles*',
                'permission' => 'view-roles',
            ],
            [
                'title' => 'Permissions',
                'icon' => 'fas-key',
                'route' => 'permissions.index',
                'active' => 'permissions*',
                'permission' => 'view-permissions',
            ],
        ],
    ],
    [
        'title' => 'Characters',
        'icon' => 'fas-user-astronaut',
        'route' => 'characters.index',
        'active' => 'characters*',
        'permission' => 'view-characters',
    ],
    [
        'title' => 'Playground',
        'icon' => 'fas-robot',
        'route' => 'playground.index',
        'active' => 'playground*',
        'permission' => null, // Bebas diakses semua user terautentikasi
    ],
    
];