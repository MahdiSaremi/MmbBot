<?php

use Mmb\Db\Db;
use Mmb\Db\QueryBuilder;
use Mmb\Db\QueryCol;
use Mmb\Db\Relation\Morph;
use Mmb\Exceptions\MmbException;
use Mmb\Tools\ATool;
use Models\En;
use Models\MA;
use Models\MB;
use Models\MC;
use Models\MD;
use Models\RelA;
use Models\RelAb;
use Models\RelB;

require __DIR__ . '/load.php';

// echo __('test', [ 'number' => 5 ]);

// $a = arr([ ['a' => 1, 'b' => 2, 'c' => 5], ['a' => 3, 'b' => 4] ]);

// print_r($a->assocBy('a')->pluckMap('b'));

print(__([
    'fa' => "تعداد: %0%",
    'en' => "Count: %0%",
], 5));

die;

// function x()
// {
//     $exp = new Exception();

//     $target = last($exp->getTrace());
//     echo getLineText($target['file'], $target['line']);
// }

// function getLineText($file, $line)
// {
//     $file = fopen($file, 'r');
//     $currentLine = 0;
//     do
//     {
//         $lastLine = fgets($file);
//         $currentLine++;
//     }
//     while($currentLine < $line);

//     return trim($lastLine);
// }

// x();


// for($i = 0; $i < 1000; $i++)
// {
//     RelA::create([
//         'name' => "User $i",
//     ]);
// }

// for($i = 0; $i < 1000; $i++)
// {
//     RelB::create([
//         'name' => "Job $i",
//     ]);
// }

// foreach(RelA::all() as $a)
// {
//     for($i = 0, $max = rand(1, 100); $i < $max; $i++)
//     {
//         $randJob = rand(1, 1000);
//         RelAb::create([
//             'a_id' => $a->id,
//             'b_id' => $randJob,
//         ]);
//     }
// }

// echo "Success!";

// die;

function tt(Closure $callback)
{
    $start = microtime(true);
    $callback();
    $end = microtime(true);
    echo ">> Time : " . round(($end - $start) * 1000) . 'ms' . "\n";
}

QueryBuilder::queryExecuting(function($query)
{
    echo "\n>> " . $query->query, "\n\n";
});

// print_r(MA::query()->groupBy('m_type')->count());

print_r(RelA::query()
    ->withQuery('b')
    ->having(RelB::column('name'), 'Police')
    ->all()
    ->pluck('allData'));

// print_r(arr([
//     [ 'id' => 1, 'likers' => [1, 2, 3, 4] ],
//     [ 'id' => 2, 'likers' => [5, 7, 2] ],
//     [ 'id' => 3, 'likers' => [5, 5] ],
//     [ 'id' => 4, 'likers' => [] ],
//     [ 'id' => 5, 'likers' => [1, 1, 1, 1, 1] ],
// ])->whereHas('likers', '=', 3)->pluck('id')->toArray());
die;

// tt(function()
// {
//     $ab = RelA::find("Alireza", 'name')->ab()->pluck('b_id');
//     print_r(
//         RelB::query()->whereIn('id', $ab)->all()->pluck('name')->toArray()
//     );
// });

// tt(function()
// {
//     $ab = RelA::find("Alireza", 'name')->ab()->pluck('b_id');
//     // print_r(
//         RelB::query()->whereIn('id', $ab)->all()->pluck('name')->toArray()
//     // );
//     ;
// });

// $id = RelA::find("Alireza", 'name')->id;
// $user = RelA::find(10);

// echo "\nTest2...\n";
// tt(function() use($id, $user)
// {
//     for($i = 0; $i < 1; $i++)
//     {
//         // $in = RelAb::query()->where('a_id', $id)->pluck('b_id');
//         // RelB::query()->whereIn('id', $in)->all();
//         $user->b()->all();
//     }
// });

// Db::query()->createOrEditTable('test33', function(QueryCol $table)
// {
//     $table->id();
//     $table->unsignedBigint('id2_changed')->fromName('id2');
//     $table->unsignedInt('a_id')->nullable()->foreign(RelA::class)->onDeleteCascade();
// });

Morph::globalInstead([
    MA::class => 'A',
    MB::class => 'B',
    MC::class => 'C',
    MD::class => 'D',
]);

MA::createOrEditTables([
    MA::class,
    MB::class,
    MC::class,
    MD::class,
]);

// MC::create([
//     'name' => "B 1",
// ]);

// MA::create([
//     'name' => "A 2",
//     'm_type' => MC::class,
//     'm_id' => MC::query()->getCell('id'),
// ]);

// foreach(MA::query()->with('mp')->all() as $a)
// {
//     echo $a->name . "\t\t" . @$a->mp->pluck('name')->implode(', ') . "\n";
// }
// foreach(MB::query()->with('mp')->all() as $a)
// {
//     echo $a->name . "\t\t" . @$a->mp->pluck('name')->implode(', ') . "\n";
// }


// AddRel('col', 'col2')

// foreach(MB::query()->with('a')->all() as $b)
// {
//     echo $b->name . "\t\t" . $b->a->name . "\n";
// }



// echo "\nTest3...\n";
// tt(function() use($id)
// {
//     for($i = 0; $i < 1; $i++)
//     {
//         RelB::query()->whereRaw(
//             RelAb::query()->where('a_id', $id)->andWhereCol('b_id', RelB::column('id'))->select('COUNT(*)')->limit(1)
//         )->all();
//     }
// });

// $a = RelA::query()->with('ab')->find(50);

// echo $a->name . "\t\t" . $a->b->pluck('id')->implode(", ");

// $a->ab()->create([
//     'b_id' => 150,
// ]);

// $a->refresh();

// echo $a->name . "\t\t" . $a->b->pluck('id')->implode(", ");
