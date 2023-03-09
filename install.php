<?php

use Mmb\Db\Table\Table;
use Mmb\Mmb;

require_once __DIR__ . '/load.php';



$dir = __DIR__;




// Install setwebhook
if(!file_exists("$dir/core"))
{
    InstallSetwebhook:

    $random = md5(microtime(true));
    @mkdir("$dir/core");
    file_put_contents("$dir/core/update-$random.php", '
<?php
// Tip: Delete me and run install.php to create new update handler!
require __DIR__ . \'/../load.php\';

Mmb\Kernel\Kernel::handleUpdate(
    app(Providers\UpdProvider::class)
);
    ');
    file_put_contents("$dir/core/fake.php", "<?php // None");
    file_put_contents("$dir/core/.htaccess", "
RewriteEngine on
RewriteCond %{REQUEST_FILENAME} !-d
RewriteCond %{REQUEST_FILENAME} !-f
RewriteRule ^ fake.php
    ");

    Mmb::$this->setWebhook(config('app.url') . "/core/update-$random.php");

}

// Setwebhook again
else
{

    $files = glob("$dir/core/update-*.php");
    if (!$files)
        goto InstallSetwebhook;

    $file = explode("/", $files[0]);
    $file = end($file);

    Mmb::$this->setWebhook(config('app.url') . "/core/$file");

}






// Install or update database
$tables = config()->get('database.tables', []);
Table::createOrEditTables($tables);




?>
<p>
    <span style="color: darkorchid">
        Webhook:
    </span>
    <span style="color: darkseagreen">
        Success
    </span>
</p>
<p>
    <span style="color: darkorchid">
        Database:
    </span>
    <span style="color: darkseagreen">
        Success
    </span>
</p>