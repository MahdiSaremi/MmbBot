<?php

use Mmb\Guard\Role;

include __DIR__ . '/load.php';

echo Role::getConstantsFor('developer|admin|debugger', true), "\n";
