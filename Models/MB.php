<?php
#auto-name
namespace Models;

use Mmb\Db\QueryCol;
use Mmb\Db\Table\Table;

class MB extends Table
{

    public static function getTable()
    {
        return 'mbs';
    }

    public static function generate(QueryCol $table)
    {
        $table->id();
        $table->text('name');
    }

    public function as()
    {
        return $this->morphMany(MA::class, 'm');
    }

    public function a()
    {
        return $this->morphOne(MA::class, 'm');
    }

}
