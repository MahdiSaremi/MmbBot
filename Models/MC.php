<?php
#auto-name
namespace Models;

use Mmb\Db\QueryCol;
use Mmb\Db\Table\Table;

class MC extends Table
{

    public static function getTable()
    {
        return 'mcs';
    }

    public static function generate(QueryCol $table)
    {
        $table->id();
        $table->text('name');
        $table->unsignedBigint('a_id');
        $table->morphs('m', [ MA::class, MB::class ]);
        $table->enum('test', En::class);
    }

}

enum En : string
{

    case A = 'aa';

    case B = 'bb';

}
