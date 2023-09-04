<?php

return [

    # Robot
    'token' => [
        'type' => 'text',
        'title' => "توکن ربات:",
        'default' => '',
        'required' => "توکن ضروری است!",
        'save' => 'TOKEN',
    ],
    'username' => [
        'type' => 'text',
        'title' => "یوزرنیم ربات",
        'default' => '',
        'save' => 'USERNAME',
    ],


    # Application
    'NAME' => "Mmb",
    'DEBUG' => false,
    'url' => [
        'type' => 'text',
        'title' => "لینک:",
        'default' => function()
        {
            return 'https://google.com';
        },
        'save' => 'URL',
    ],


    # Database
    'DB_DRIVER' => Mmb\Db\Driver\MySql\MySql::class,
    'DB_HOST' => '127.0.0.1',
    'DB_PORT' => null,
    'db_username' => [
        'type' => 'text',
        'title' => "نام کاربری دیتابیس:",
        'required' => "نام کاربری ضروری است!",
        'save' => 'DB_USERNAME',
    ],
    'db_password' => [
        'type' => 'text',
        'title' => "رمز عبور دیتابیس:",
        'required' => "رمز عبور ضروری است!",
        'save' => 'DB_PASSWORD',
    ],
    'db_name' => [
        'type' => 'text',
        'title' => "نام دیتابیس:",
        'required' => "نام دیتابیس ضروری است!",
        'save' => 'DB_NAME',
    ],
    'db_prefix' => [
        'type' => 'text',
        'title' => "پیشوند نام جداول (دلخواه):",
        'save' => 'DB_PREFIX',
    ],


    # Pay
    'PAY_MAIN_DRIVER' => Mmb\Pay\Web\NextPay::class,
    'pay_key' => [
        'type' => 'text',
        'title' => "کلید درگاه:",
        'save' => 'PAY_MAIN_KEY',
    ],


    # Roles constant
    'developer' => [
        'type' => 'text',
        'title' => "ادمین اصلی:",
        'save' => function($value, &$env)
        {
            if($value)
                @$env['ROLES_CONST'][$value] = 'developer';
        }
    ],

];
