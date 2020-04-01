<?php

return [
    'role_structure' => [
        'seeker' => [
            'jobs' => 'r,s',
        ],
        'company' => [
            'jobs' => 'c,r,u,d',
        ],
    ],
    
    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete',
        's' => 'save',
    ]
];
