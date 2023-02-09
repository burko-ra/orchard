<?php

namespace Orchard\Trees;

abstract class Tree
{
    private int $id;
    private int $yield = 0;

    public static string $type = 'tree';

    public function __construct(int $id)
    {
        $this->id = $id;
        $this->yield = $this->calculateYield();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getType(): string
    {
        return static::$type;
    }

    public function getYield(): int
    {
        return $this->yield;
    }

    public function setYield(int $value): void
    {
        $this->yield = $value;
    }

    public function giveYield(): int
    {
        $yieldToGive = $this->getYield();
        $this->setYield(0);
        return $yieldToGive;
    }

    abstract protected function calculateYield(): int;
}
