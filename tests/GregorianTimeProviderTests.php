<?php

use Foamycastle\Utilities\Providers\GregorianTimeProvider;

include '../vendor/autoload.php';

//Test Constructor
    $tester  = new GregorianTimeProvider();

//Test getValue()
    echo "Time Value: ".$tester->getValue() . PHP_EOL;

    $getValue = $tester->getValue();
    $provide = $tester->provide(false);

    echo "getValue() and provide() ".($getValue==$provide ? 'give ':'do not give ')."the same value" .PHP_EOL;

//After a call to refresh via the provide method, expect a different value to be return
    echo "call to provide with refresh=true".PHP_EOL;
    $provide = $tester->provide(true);

    echo "getValue() and provide() ".($getValue==$provide ? 'give ':'do not give ')."the same value" .PHP_EOL;
    echo "time value after refresh: ".$provide.PHP_EOL;

//Test bitwise functions

    echo "bit shift right: ". $shiftR=$tester->shiftRight(48)->getValue() .PHP_EOL;
    echo "hex output: ".dechex($shiftR).PHP_EOL;

//Continued calls