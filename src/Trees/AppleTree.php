<?php

namespace Orchard\Trees;

class AppleTree extends Tree
{
    private $id;
    private $yield;

    public static $type = 'apple tree';
    private static $productivity = ['min' => 40, 'max' => 50];

    protected function calculateYield()
    {
        return rand(self::$productivity['min'], self::$productivity['max']);
    }

}