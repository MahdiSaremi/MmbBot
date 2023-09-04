<?php
#auto-name
namespace App\Addon\Panel\ForAll\Models;

use Mmb\Compile\Attributes\AsModel;
use Mmb\Db\QueryCol;
use Mmb\Db\Table\Table;

#[AsModel]
class ForAllQueue extends Table
{

    public static function getTable()
    {
        return 'for_all_queue';
    }

    public static function generate(QueryCol $table)
    {
        $table->id();
        $table->string('method', 10);
        $table->json('args', true);
        $table->int('offset')->default(0);
    }
    
}
