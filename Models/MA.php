<?php
#auto-name
namespace Models;

use Mmb\Db\QueryCol;
use Mmb\Db\Table\Table;

class MA extends Table
{

    public static function getTable()
    {
        return 'mas';
    }

    public static function generate(QueryCol $table)
    {
        $table->id();
        $table->text('name');

        $table->tinytext('m_type');
        $table->unsignedBigint('m_id');
    }

    public function m()
    {
        return $this->morphTo('m');
    }

    public function mp()
    {
        return $this->morphToMany(MC::class, 'm', 'a_id');
    }

}
