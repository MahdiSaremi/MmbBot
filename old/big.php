<?php
use Mmb\Big\BigNumber;

include __DIR__ . '/vendor/autoload.php';

// $a = new BigNumber("7");
// $b = new BigNumber("-2");
// $c = $a->mod($b);

// echo "\n";
// echo ">> $a % $b = $c";
// echo "\n\n";

$two = new BigNumber("1024.5");
$n = new BigNumber("1");
for($i = 0; $i < 100; $i++)
    $n = $n->multiply($two);
echo $n->format(2);
