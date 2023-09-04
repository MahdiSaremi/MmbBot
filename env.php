<?php


return [


    # Robot
    'TOKEN' => '',
    'USERNAME' => '',
    

    # Application
    'NAME' => "Mmb",
    'DEBUG' => true,
    'LANG' => 'fa',
    'URL' => '',


    # Database
    'DB_DRIVER' => Mmb\Db\Driver\MySql\MySql::class,
    'DB_HOST' => '127.0.0.1',
    'DB_PORT' => null,
    'DB_USERNAME' => 'root',
    'DB_PASSWORD' => '',
    'DB_NAME' => 'test',
    'DB_PREFIX' => '',
    'DB_USER' => \Models\User::class,


    # Pay
    'PAY_MAIN_DRIVER' => Mmb\Pay\Web\NextPay::class,
    'PAY_MAIN_KEY' => '',


    # Roles constant
    'ROLES_CONST' => [
        // 123456789 => 'developer',
        1 => 'developer',
        2 => 'admin',
        3 => 'developer|debugger',
        // id => 'role1|role2|role3',
    ],


];
