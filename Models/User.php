<?php

namespace Models; #auto

use App\Actions\Menu;
use Mmb\Controller\StepHandler\HasStep;
use Mmb\Controller\StepHandler\StepHandler;
use Mmb\Db\QueryCol;
use Mmb\Db\Table\Table;
use Mmb\Guard\HasRole;
use Mmb\Guard\Role;

class User extends Table
{
    use HasStep;
    use HasRole;
    
    /** @var User */
    public static $this;
    
    public static function getTable()
    {
        return 'users';
    }


    /** @var int */
    public $id;
    /** @var Role */
    public $role;

    public function modifyDataIn(array &$data)
    {
        $this->modifyStepIn($data);
        $this->modifyRoleIn($data);
    }

    public function modifyDataOut(array &$data)
    {
        $this->modifyStepOut($data);
        $this->modifyRoleOut($data);
    }

    public static function generate(QueryCol $table)
    {
        $table->unsignedBigint('id')->primaryKey();
        
        self::stepColumn($table);
        self::roleColumn($table);
    }

    public static function createUser($id)
    {
        return self::create([
            'id' => $id,
            'step' => null,
            'role' => null,
        ]);
    }
    
}
