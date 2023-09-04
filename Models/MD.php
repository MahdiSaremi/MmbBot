<?php
#auto-name
namespace Models;

use Mmb\Db\QueryCol;
use Mmb\Db\Table\Table;

class MD extends Table
{

    public static function getTable()
    {
        return 'mds';
    }

    public static function generate(QueryCol $table)
    {
        $table->id();
        $table->text('name');
    }

}
