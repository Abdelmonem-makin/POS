<?php

use App\Models\supplier;

return [
    /**
     * Control if the seeder should create a user per role while seeding the data.
     */
    'create_users' => false,

    /**
     * Control if all the laratrust tables should be truncated before running the seeder.
     */
    'truncate_tables' => true,

    'roles_structure' => [
        'super_admin' => [
            'users' => 'c,r,u,d',
            'Category' => 'c,r,u,d',
            'Product' => 'c,r,u,d',
            'Order' => 'c,r,u,d',
            'Stock' => 'c,r,u,d',
            'supplier' => 'c,r,u,d'
        ],
        'Admin' => []
    ],

    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete'
    ]
];
