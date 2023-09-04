<?php

use Mmb\Big\BigNumber;
use Mmb\Db\Driver\MySql\MySql;
use Mmb\Db\Table\Table;
use Mmb\Mapping\Arr;
use Mmb\Mapping\Map;
use Models\User;

include __DIR__ . '/load.php';

MySql::defaultStatic()->connect('localhost', 'root', '', 'test');


class Order extends Table
{
    public static function getTable()
    {
        return 'orders';
    }
}
class Product extends Table
{
    public static function getTable()
    {
        return 'products';
    }
}


$map1 = new Map([
    'a' => "Mahdi",
    'b' => 19,
]);
$map2 = new Map([
    'a' => "Ali",
    'c' => true,
]);
$map3 = new Map([
    'b' => 22,
    'c' => false,
]);

print_r(
    $map1->merge($map2, $map3)
    ->toArray()
);

die;


// print_r(
//     User::query()
//         // ->selectCols([ 'id' => User::column('id'), 'message', 'parent_message' => 'parents.message' ])
//         // ->crossJoinAs(User::class, 'parents', 'parents.id', User::column('id'))
//         // ->all()
//         // ->leftJoinSub(Order::query()->where('time', '>', time() - 360000), 'orders', 'orders.user_id', User::column('id'))
//         ->createQuery()
//         // ->all()
// );

// $arr = new Arr([
//     [
//         'name' => "Mahdi",
//     ],
//     [
//         'name' => "Ali",
//     ],
// ]);
$arr = new Arr(User::all());

// foreach($arr as $x)
// {
//     echo new Arr($x), " , ";
// }
$arr = $arr->append(...$arr);
$arr = $arr->append(...$arr);
$arr = $arr->append(...$arr);
$arr = $arr->append(...$arr);
$arr = $arr->append(...$arr);
$arr = $arr->append(...$arr);
$arr = $arr->append(...$arr);
$arr = $arr->append(...$arr);

echo "Count: {$arr->count()}\n";

difTime(function() use($arr) {
    // echo "\n" . 
    $arr->pluck('name') . "\n";
});

difTime(function() use($arr) {
    // echo "\n" . 
    $arr->pluck('age')->sortDesc();// . "\n";
});
// echo $arr->pluck('name')->containsAll(['Mahdi', 'Alireza', 'Salar']) ? "True" : "False";






exit;

function difTime($callback)
{
    $start = microtime(true);
    $callback();
    $end = microtime(true);

    echo round(($end - $start) * 1000) . 'ms' . "\n";
}

echo "init", "\t\t";
$array = [];
difTime(function() use(&$array)
{
    $array = array_map('md5', range(1, 1000000));
});
