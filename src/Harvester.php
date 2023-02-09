<?php

namespace Orchard;

use Orchard\Trees\Tree;

class Harvester
{
    private $cargo = [];

    public function getCargo()
    {
        return $this->cargo;
    }

    public function harvest(Tree $tree)
    {
        $type = $tree->getType();
        $yield = $tree->giveYield();
        $this->addToCargo($type, $yield);
    }

    private function addToCargo($type, $yield)
    {
        $this->cargo[$type] = ($this->cargo[$type] ?? 0) + $yield;
    }

    public function __toString()
    {
        $summary = $this->getCargo();
        $lines = array_map(
            fn($key, $value) => "{$value} units of {$key}",
            array_keys($summary),
            $summary
        );
        $firstPart = $summary ? "The harvester contains: " : "The harvester contains no fruits";

        return $firstPart . implode(", ", array_merge($lines)) . '.';
    }
}
