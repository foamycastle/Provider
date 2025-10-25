<?php

include '../vendor/autoload.php';

use Foamycastle\Utilities\Providers\UUIDProvider;


//Expects the output to be fully random
$provider = new UUIDProvider('');
echo "UUID Provider Output: ".PHP_EOL.PHP_EOL;
echo "Expected Random Output: ".$provider->provide(false).PHP_EOL.PHP_EOL;

//Expects the output to be the same as input
$inputData = '12345678-abcd-ef01-2345-6789abcdef01';
$provider = new UUIDProvider($inputData);
echo "Input Data: ".$inputData.PHP_EOL;
echo "Expected Input Output: ".$provider->provide(false).PHP_EOL.PHP_EOL;

//Expects the output to be translated from canonical binary to ascii hex
$inputData = random_bytes(16);
$provider = new UUIDProvider($inputData);
echo "Input Data: ".$inputData.PHP_EOL;
echo "Expected Input Output: ".$provider->provide(false).PHP_EOL.PHP_EOL;
