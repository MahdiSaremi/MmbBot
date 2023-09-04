<?php

return [

    /**
     * Project name
     */
    'name' => env('NAME', 'Mmb Project'),


    /**
     * Default language
     */
    'lang' => env('LANG', 'fa'),
    
    
    /**
     * Debug mode
     */
    'debug' => env('DEBUG', false),


    /**
     * App url
     */
    'url' => env('URL', ''),


    /**
     * Update types
     */
    'updates' => [

        'msg',
        // 'editedMsg',

        'callback',
        // 'joinReq',

        'inline',
        // 'chosenInline',

        // 'chatMember',
        // 'myChatMember',

        // 'post',
        // 'editedPost',

        // 'poll',
        // 'pollAnswer',

    ],
    
];
