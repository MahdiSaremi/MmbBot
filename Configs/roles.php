<?php

return [

    /**
     * Roles name and properties
     */
    'roles' => [

        /**
         * Developer (Full admin)
         */
        'developer' => [

            'fa' => "مدیر اصلی",

            'access_panel' => true,
            'manage_admins' => true,
            'ignore_ban' => true,

        ],

        /**
         * Admin
         */
        'admin' => [

            'fa' => "ادمین",

            'access_panel' => true,
            'ignore_ban' => true,

        ],

        /**
         * Debugger (Error logs for custom debug plugins)
         */
        'debugger' => [

            'fa' => "دیباگر",

            'debugger' => true,

        ],

        /**
         * Defualt
         */
        'default' => [

            'fa' => "کاربر",

        ],

    ],


    /**
     * Relates users to role (out of database)
     */
    'const' => env('ROLES_CONST', [ ]),

];
