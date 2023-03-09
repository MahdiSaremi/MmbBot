<?php

return [

    'handlers' => [

        /**
         * Before handlers
         */
        App\Home\Start\StartController::startCommand(),
        
        
        /**
         * Current handlers
         */
        app('step'),



        /**
         * After handles
         */


    ],

    'condition' => function()
    {
        return app('user_or_create');
    },

];
