<?php
#auto-name
namespace Models;

use Mmb\Db\QueryCol;
use Mmb\Db\Table\Model;

class RelB extends Model
{

    public static function getTable()
    {
        return 'rel_b';
    }

    public static function generate(QueryCol $table)
    {
        $table->id();
        $table->text('name');
    }
    
    public function ab()
    {
        return $this->hasMany(RelAB::class, 'b_id');
    }
    
}
