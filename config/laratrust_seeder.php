<?php

return [
    'role_structure' => [
        'sudo' => [
            'logs' => 'c,r,u,d',
            'users' => 'c,r,u,d',
            'profile' => 'r,u',
            'products' => 'c,r,u,d',
            'orders' => 'c,r,u,d',
            'purchases' => 'c,r,u,d',
        ],
        'admin' => [
            'users' => 'c,r,u,d',
            'profile' => 'r,u',
            'products' => 'c,r,u,d',
            'orders' => 'c,r,u,d',
            'purchases' => 'c,r,u,d',
        ],
        'user' => [
            'profile' => 'r,u',
            'products' => 'c,r,u,d',
            'orders' => 'c,r,u,d',
            'purchases' => 'c,r,u,d',
        ],
    ],
    'permission_structure' => [],
    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete',
    ],
];
