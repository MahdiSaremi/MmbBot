<?php
#auto-name
namespace Providers;

use Mmb\Provider\Provider;

class EnvProvider extends Provider
{

    public function register()
    {
        $this->setStoragePath(__DIR__ . '/../Storage');

        $this->loadEnvFrom(__DIR__ . '/../env.php');
    }
    
}
