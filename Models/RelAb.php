<?php
#auto-name
namespace Models;

use Mmb\Db\QueryCol;
use Mmb\Db\Table\Model;

class RelAb extends Model
{

    protected $with = ['a'];

    public static function getTable()
    {
        return 'rel_ab';
    }

    public static function generate(QueryCol $table)
    {
        $table->id();
        $table->unsignedBigint('a_id')->foreign(RelA::class);
        $table->unsignedBigint('b_id')->foreign(RelB::class);
    }

    public function a()
    {
        return $this->belongsTo(RelA::class, 'a_id')->rollback('ab0');
    }
    
    public function b()
    {
        return $this->belongsTo(RelB::class, 'b_id');
    }
    
}
