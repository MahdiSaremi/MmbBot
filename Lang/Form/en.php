<?php

return [

    'invalid' => [
        
        'text' => "Only text message is acceptable",
        'single_line' => "Your text should be one line",

        'int' => "Only non-decimal numbers are acceptable",
        'number' => "Only one number is acceptable",
        'unsigned' => "Only positive numbers are acceptable",

        'msg' => "Only message is acceptable",
        'media' => "Only media message is acceptable",
        'photo' => "Only video message is acceptable",
        'msg_type' => "This message type is not supported",

        'options' => "You can only use options",
        
    ],

    'filter' => [

        'min_text' => "Your text length must be at least %min%",
        'min_number' => "Your number must be at least %min%",

        'max_text' => "The length of your text should be %max%",
        'max_number' => "Your number must be at most %max%",

        'unique' => "This @{attributes.%column%}?{%column%} already exists",
        'exists' => "This @{attributes.%column%}?{%column%} does not exist",

    ],

    'attributes' => [



    ],

    'form_keys' => [

        'cancel' => "Cancel",
        'skip' => "Skip",

    ],

];
