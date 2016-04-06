<?php

return [

    'domain' => '{{domain}}',

    'db' => [
        'default' => [
            'driver'   => 'mysql',
            'host'     => '127.0.0.1',
            'dbname'   => 'php3',
            'user'     => 'root',
            'password' => '{{db.password}}'
        ]
    ]

];