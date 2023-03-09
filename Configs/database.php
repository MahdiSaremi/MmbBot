<?php

return [

    /**
     * Database driver
     */
    'driver' => env('DB_DRIVER', Mmb\Db\Driver\MySql\MySql::class),


    /**
     * Host
     */
    'host' => env('DB_HOST', 'localhost'),

    
    /**
     * Port
     */
    'port' => env('DB_PORT', null),


    /**
     * Username
     */
    'username' => env('DB_USERNAME'),

    
    /**
     * Password
     */
    'password' => env('DB_PASSWORD'),


    /**
     * Database name
     */
    'name' => env('DB_NAME'),


    /**
     * Tables prefix name (Table::setPrefix('prefix_'))
     */
    'prefix' => env('DB_PREFIX', ''),


    /**
     * Database tables class for installation
     */
    'tables' => [

        Models\User::class,

    ],

];
