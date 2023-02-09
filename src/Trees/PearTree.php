<?php

namespace Orchard\Trees;

class PearTree extends Tree
{
    public static string $type = 'pear tree';

    /**
     * @var array<string,int>
     */
    private static $productivity = ['min' => 0, 'max' => 20];

    protected function calculateYield(): int
    {
        return rand(self::$productivity['min'], self::$productivity['max']);
    }
}
