<?php

/**
 * Commands used for retrieving the hardware mac address of a system, required for certain versions of UUID
 */
const NETWORK_ADAPTER_COMMANDS=[
    //Linux Commands
    'LIN'=>[

        ['ifconfig -a', '/(?i)(?<=ether |hwaddr )([a-f0-9(\-:)]{17})/'],
        ['ip -a',       '/(?i)(?<=ether |hwaddr )([a-f0-9(\-:)]{17})/']
    ],
    //Windows commands
    'WIN'=>[
        ['ipconfig /all | findstr "Physical Address"','/(?i)(?>(?:Physical Address)(?:(?:. )*: ))([a-f0-9(\-:)]{17})/']
    ],
    //Mac OS Commands
    'DAR'=>[
        ['ifconfig',    '/(?i)(?<=ether |hwaddr )([a-f0-9(\-:)]{17})/']
    ],
    //FREE BSD commands
    'FRE'=>[
        ['ifconfig',    '/(?i)(?<=ether |hwaddr )([a-f0-9(\-:)]{17})/']
    ]

];

const HW_ADDRESS = "ethernet_hardware_addresses";




