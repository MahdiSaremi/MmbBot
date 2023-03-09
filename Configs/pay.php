<?php

use Mmb\Pay\Web\NextPay;
use Mmb\Pay\Web\ZarinPal;

/**
 * Pay objects will create as app('pay.NAME')
 */
return [

    /**
     * Enable debug mode
     */
    'debug' => config('app.debug'),


    /**
     * Pay callback url
     */
    'url' => config('app.url') . '/pay.php',



    /**
     * All pay configs
     */
    'all' => [

        /**
         * Main pay object
         * app('pay.main')
         * app(PayDriver::class) // Just for 'main'
         * function test(PayDriver $pay) // Just for 'main'
         */
        'main' => [

            /**
             * Name of driver class
             */
            'driver' => env('PAY_MAIN_DRIVER', NextPay::class),

            /**
             * Access key
             */
            'key' => env('PAY_MAIN_KEY'),

        ],


        

        /**
         * Example pay object
         * app('pay.example')
         * app(ExmaplePay::class) // Name of pay class
         * function test(ExamplePay $pay) // Name of pay class
         */
        // 'exmaple' => [

        //     /**
        //      * Name of driver class
        //      */
        //     'driver' => ExamplePay::class,

        //     /**
        //      * Access key
        //      */
        //     'key' => "",

        //     /**
        //      * Custom debug mode (default = pay.debug)
        //      */
        //     // 'debug' => true,

        //     /**
        //      * Custom callback url (default = pay.url)
        //      */
        //     // 'url' => '',

        // ],

    ],

];
