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

            'access_panel' => true,
            'manage_admins' => true,
            'ignore_ban' => true,

        ],

        /**
         * Admin
         */
        'admin' => [

            'access_panel' => true,
            'ignore_ban' => true,

        ],

        /**
         * Defualt
         */
        'default' => [

        ],

    ],


    /**
     * Relates users to role (out of database)
     */
    'const' => env('ROLES_CONST', [ ]),

];
