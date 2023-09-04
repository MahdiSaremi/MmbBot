<?php
#auto-name
namespace Providers;

use Mmb\Background\Background;
use Mmb\Provider\Provider;

class BackgroundProvider extends Provider
{

    public function register()
    {
        $this->loadConfigFrom(__DIR__ . '/../Configs/background.php', 'background');

        Background::$targetUrl = config('background.url');
    }

}
