<?php

namespace Orchard\Trees;

class PearTree extends Tree
{
    private $id;
    private $yield;

    public static $type = 'pear tree';
    private static $productivity = ['min' => 0, 'max' => 20];

    protected function calculateYield()
    {
        return rand(self::$productivity['min'], self::$productivity['max']);
    }
}
