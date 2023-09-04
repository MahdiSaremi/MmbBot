<?php

namespace Providers; #auto

use Mmb\Db\Db;
use Mmb\Db\Table\Table;
use Mmb\Provider\Provider;

class DatabaseProvider extends Provider
{

    public function register()
    {
        $this->loadConfigFrom(__DIR__ . '/../Configs/database.php', 'database');

        $driver = config('database.driver');
        $driver::setAsDefault();

        \Mmb\Db\Driver::defaultStatic()->config('database');
        Table::setPrefix(config()->get('database.prefix', ''));

        Db::setDefaultUserClass(config()->get('database.user'));

        $this->onInstance('db', function() {
            return \Mmb\Db\Driver::defaultStatic();
        });
    }

    public function boot()
    {
        
    }
    
}
