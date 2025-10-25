<?php

include '../vendor/autoload.php';
//include '../bin/loadenv.php';

use Foamycastle\Utilities\UUID\Providers\WindowsNetworkAddress;
echo "start: ". microtime(true).PHP_EOL;
echo (new WindowsNetworkAddress()).PHP_EOL;
echo "end: ". microtime(true).PHP_EOL;



