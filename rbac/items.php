<?php
return [
    'createProduct' => [
        'type'        => 2,
        'description' => 'Create a product',
    ],
    'updateProduct' => [
        'type'        => 2,
        'description' => 'Update product',
    ],
    'deleteProduct' => [
        'type'        => 2,
        'description' => 'Delete product',
    ],

    'author'        => [
        'type'     => 1,
        'children' => [
            'createProduct',
            'updatePost',
        ],
    ],
    'admin'         => [
        'type'     => 1,
        'children' => [
            'deleteProduct',
            'createProduct',
            'updatePost',
        ],
    ],
];
