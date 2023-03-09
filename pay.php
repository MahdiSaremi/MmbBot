<?php

use Mmb\Pay\PayDriver;

require __DIR__ . '/load.php';




foreach (config('pay.all') as $name => $config)
    if (app("pay.$name")->execute())
        exit;

// Error:
?>
پرداخت انجام نشد! اگر مبلغ از حساب شما کسر شده است، تا نهایت 72 ساعت آینده توسط بانک به حساب شما باز میگردد