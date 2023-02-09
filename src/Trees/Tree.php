<?php

namespace Orchard\Trees;

abstract class Tree
{
    private $id;
    private $yield = 0;

    public static $type = 'tree';

    public function __construct($id)
    {
        $this->id = $id;
        $this->yield = $this->calculateYield();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getType()
    {
        return static::$type;
    }

    public function getYield()
    {
        return $this->yield;
    }

    public function setYield($value)
    {
        $this->yield = $value;
    }

    public function giveYield()
    {
        $yieldToGive = $this->getYield();
        $this->setYield(0);
        return $yieldToGive;
    }

    abstract protected function calculateYield();
}