<?php
#auto-name
namespace Providers;

use Mmb\Provider\Provider;

class EnvProvider extends Provider
{

    public function register()
    {
        $this->loadEnvFrom(__DIR__ . '/../env.php');
    }
    
}
