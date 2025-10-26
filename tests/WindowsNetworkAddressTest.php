<?php

include '../vendor/autoload.php';
//include '../bin/loadenv.php';

use Foamycastle\Utilities\UUID\Providers\NetworkAdapterProvider;
use Foamycastle\Utilities\Env;
echo "start: ". microtime(true).PHP_EOL;
echo (new NetworkAdapterProvider())->provide(false)[0].PHP_EOL;
$address=new NetworkAdapterProvider();
echo "cached: ". $address->provide(false)[1].PHP_EOL;
Env::Set(HW_ADDRESS, $address->provide(false));
echo "From Env:".env(HW_ADDRESS)[0].PHP_EOL;
echo "From Env:".env(HW_ADDRESS)[1].PHP_EOL;
echo "end: ". microtime(true).PHP_EOL;



