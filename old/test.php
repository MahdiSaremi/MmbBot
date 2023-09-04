<?php

use Mmb\Calling\Caller;
use Mmb\Calling\Property;
use Mmb\Calling\PropertyMemory;
use Mmb\Controller\Controller;
use Mmb\Guard\Attributes\AllowRequire;
use Mmb\Guard\Guard;

require __DIR__ . '/load.php';



class Test extends Controller
{

    public function first()
    {
        echo "First!\n";
    }

    #[AllowRequire('test')]
    public function test()
    {
        echo "Hi!\n";
    }

}

Test::invoke('first');
Test::invoke('test');

