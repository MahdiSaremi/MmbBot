<?php

namespace Models; #auto

use App\Actions\Menu;
use Mmb\Controller\StepHandler\HasStep;
use Mmb\Controller\StepHandler\StepHandler;
use Mmb\Db\QueryCol;
use Mmb\Db\Table\Table;
use Mmb\Guard\HasRole;
use Mmb\Guard\Role;

/**
 * @property Role $role
 */
class User extends Table
{
    use HasRole;
    
    /** @var User */
    public static $this;
    public static function this()
    {
        return static::$this;
    }
    
    public static function getTable()
    {
        return 'users';
    }


    public static function generate(QueryCol $table)
    {
        $table->unsignedBigint('id')->primaryKey();
        $table->step();
        $table->role();
        $table->bool('ban');
        $table->int('join_at');
    }

    public static function createUser($id)
    {
        return self::create([
            'id' => $id,
            'step' => null,
            'role' => null,
            'ban' => false,
            'join_at' => time(),
        ]);
    }

    public function test()
    {
        return $this->belongsTo();
    }
    
}
