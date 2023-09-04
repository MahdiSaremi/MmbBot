<?php

use Mmb\Tools\Dev\Dev;

if(file_exists(__DIR__ . "/extractMe.php") && filesize(__DIR__ . "/extractMe.php") > 30)
{
    echo "Error: file extractMe.php will run and destroy your codes maybe! Delete file and continue? (Y/n) ";
    if(!in_array(readline(), ['y', 'Y', 'yes', 'Yes', 'YES']))
    {
        die;
    }
    file_put_contents(__DIR__ . "/extractMe.php", '<?php // None');
}

include __DIR__ . '/load.php';

Dev::loadDefault();
Dev::handle();
