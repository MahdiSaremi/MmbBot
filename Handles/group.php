<?php

return [

    'handlers' => [

        /**
         * Handlers
         */


        #region Compiler Handler
            App\None::callbackQuery(),
        #endregion
    

        /**
         * Current step handler
         */
        app('step'),



        /**
         * Final handlers
         */

        
        #region Compiler End Handler

        #endregion


    ],

    // 'condition' => function()
    // {
    //     return app('group_or_create');
    // },

];
