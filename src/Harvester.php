<?php

namespace Orchard;

class Harvester
{
    private $cargo = [];

    public function getCargo()
    {
        return $this->cargo;
    }

    public function harvest(FruitTree $tree)
    {
        $collected = $tree->takeYield();
        $this->addToCargo($collected);
    }

    private function addToCargo($collected)
    {
        $yield = $collected['yield'];
        $type = $collected['type'];
        $this->cargo[$type] = ($this->cargo[$type] ?? 0) + $yield;
    }
}
