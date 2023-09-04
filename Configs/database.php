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
     * Default user class
     */
    'user' => env('DB_USER'),


    /**
     * Database tables class for installation
     */
    'tables' => [

        #region Compiler Config
            App\Addon\Panel\ForAll\Models\ForAllQueue::class,
        #endregion
        
    ],

];
