<?php
return [
    'cache' => [
        'graphql' => [
            'id_salt' => '0WGeE1wuGlGMaQzpQcQrhZAdJlq597DU'
        ],
        'frontend' => [
            'default' => [
                'id_prefix' => '022_'
            ],
            'page_cache' => [
                'id_prefix' => '022_'
            ]
        ],
        'allow_parallel_generation' => false
    ],
    'queue' => [
        'consumers_wait_for_messages' => 1
    ],
    'remote_storage' => [
        'driver' => 'file'
    ],
    'backend' => [
        'frontName' => 'admin'
    ],
    'crypt' => [
        'key' => '35c339b45b18922baed43c7fadc6c5fb'
    ],
    'db' => [
        'table_prefix' => '',
        'connection' => [
            'default' => [
                'host' => 'localhost',
                'dbname' => 'aa63c495_training',
                'username' => 'aa63c495_train',
                'password' => 'PlaysInvertGybeLoosen',
                'model' => 'mysql4',
                'engine' => 'innodb',
                'initStatements' => 'SET NAMES utf8;',
                'active' => '1',
                'driver_options' => [
                    1014 => false
                ]
            ]
        ]
    ],
    'resource' => [
        'default_setup' => [
            'connection' => 'default'
        ]
    ],
    'x-frame-options' => 'SAMEORIGIN',
    'MAGE_MODE' => 'developer',
    'session' => [
        'save' => 'files'
    ],
    'lock' => [
        'provider' => 'db'
    ],
    'directories' => [
        'document_root_is_pub' => true
    ],
    'downloadable_domains' => [
        'localhost'
    ],
    'cache_types' => [
        'config' => 1,
        'layout' => 1,
        'block_html' => 1,
        'collections' => 1,
        'reflection' => 1,
        'db_ddl' => 1,
        'compiled_config' => 1,
        'eav' => 1,
        'customer_notification' => 1,
        'config_integration' => 1,
        'config_integration_api' => 1,
        'full_page' => 1,
        'config_webservice' => 1,
        'translate' => 1
    ],
    'install' => [
        'date' => 'Fri, 14 Jul 2023 07:22:31 +0000'
    ]
];
