<?php

use Mmb\Core\ErrorHandler;
use Mmb\Db\Table\Table;
use Mmb\Kernel\Env;
use Mmb\Mmb;
use Mmb\Update\Upd;

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

    try
    {
        Mmb::$this->setWebhook([
            'url' => config('app.url') . "/core/update-$random.php",
            'filter' => Upd::convertUpdTypes(config('app.updates')) ?: null,
        ]);
        $setWebhookResult = true;
    }
    catch(Exception $e)
    {
        ErrorHandler::defaultStatic()->error($e);
        $setWebhookResult = false;
    }

}

// Setwebhook again
else
{

    $files = glob("$dir/core/update-*.php");
    if (!$files)
        goto InstallSetwebhook;

    $file = explode("/", $files[0]);
    $file = end($file);

    try
    {
        Mmb::$this->setWebhook([
            'url' => config('app.url') . "/core/$file",
            'filter' => Upd::convertUpdTypes(config('app.updates')) ?: null,
        ]);
        $setWebhookResult = true;
    }
    catch(Exception $e)
    {
        ErrorHandler::defaultStatic()->error($e);
        $setWebhookResult = false;
    }

}






// Install or update database
$tables = config()->get('database.tables', []);
try 
{
    Table::createOrEditTables($tables);
    $databaseResult = true;
}
catch(Exception $e)
{
    $databaseResult = false;
    ErrorHandler::defaultStatic()->error($e);
}




?>
<p>
    <span style="color: darkorchid">
        Webhook:
    </span>
    <?php if($setWebhookResult) { ?>
        <span style="color: darkseagreen">
            Success
        </span>
    <?php } else { ?>
        <span style="color: red">
            Fail
        </span>
    <?php } ?>
</p>
<p>
    <span style="color: darkorchid">
        Database:
    </span>
    <?php if($databaseResult) { ?>
        <span style="color: darkseagreen">
            Success
        </span>
    <?php } else { ?>
        <span style="color: red">
            Fail
        </span>
    <?php } ?>
</p>