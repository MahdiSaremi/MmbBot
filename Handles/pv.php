<?php

return [

    'handlers' => [
        
        /**
         * Handlers
         */

        #region Compiler Handler
            App\BanBlock::instance(),
            App\Home\Start\StartController::startCommand(),
            App\Addon\ChannelLock\ChannelLockHandler::instance(),
            App\Addon\Panel\User\Profile\UserManage::callbackQuery(),
            App\Addon\Panel\User\UserList\UserAdminListShow::callbackQuery(),
            App\Addon\Panel\User\UserList\UserBanListShow::callbackQuery(),
            App\Addon\Panel\User\UserList\UserListShow::callbackQuery(),
            App\None::callbackQuery(),
            App\Panel\Panel::command(["/panel", "پنل"], 'main'),

            
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

    'condition' => function()
    {
        return app('user_or_create');
    },

];
