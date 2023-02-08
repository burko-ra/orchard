<?php

namespace Orchard;

class PrinterForHarvester
{
    public static function print(array $cargo)
    {
        array_map(function($type, $quantity) {
            print "Собрано {$quantity} плодов с деревьев типа {$type}\n";
        }, array_keys($cargo), $cargo);
    }
}