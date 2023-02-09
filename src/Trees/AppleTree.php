<?php

namespace Orchard\Trees;

class AppleTree extends Tree
{
    public static string $type = 'apple tree';

    /**
     * @var array<string,int>
     */
    private static $productivity = ['min' => 40, 'max' => 50];

    protected function calculateYield(): int
    {
        return rand(self::$productivity['min'], self::$productivity['max']);
    }
}
