<?php
#auto-name
namespace Models;

use Mmb\Db\QueryCol;
use Mmb\Db\Table\Model;

class RelA extends Model
{

    protected $with = ['ab', 'b', 'ab0'];

    public static function getTable()
    {
        return 'rel_a';
    }

    public static function generate(QueryCol $table)
    {
        $table->id();
        $table->text('name');
    }

    public function ab()
    {
        return $this->hasMany(RelAB::class, 'a_id')->rollback('a');
    }

    public function b()
    {
        return $this->belongsToMany(RelB::class, RelAb::class, 'a_id', 'b_id');
    }
    
    public function ab0()
    {
        return $this->ab()->one();
    }
    
}
