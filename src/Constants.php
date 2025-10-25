<?php

const NETWORK_ADAPTER_COMMANDS=[
    'LIN'=>[

        ['ifconfig -a', '/(?i)(?<=ether |hwaddr )([a-f0-9(\-:)]{17})/'],
        ['ip -a',       '/(?i)(?<=ether |hwaddr )([a-f0-9(\-:)]{17})/']
    ],
    'WIN'=>[
        ['ipconfig /all | findstr "Physical Address"']
    ]

];




