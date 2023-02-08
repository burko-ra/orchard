<?php

namespace Orchard;

class FruitTree
{
    private $type;
    private $isRipe = false;
    private $yield = 0;
    private $id;

    private static $productivityInfo = [
        'apple tree' => ['min' => 40, 'max' => 50],
        'pear tree' => ['min' => 0, 'max' => 20]
    ];

    public function __construct($type)
    {
        $this->type = $type;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getType()
    {
        return $this->type;
    }

    public function checkIsRipe()
    {
        return $this->isRipe;
    }

    public function getYield()
    {
        return $this->yield;
    }

    public function produceYield()
    {
        if (!$this->isRipe) {
            $this->isRipe = true;
            $this->yield = $this->calculateProductivity();
        }
    }

    public function takeYield()
    {
        if ($this->isRipe) {
            $yieldToHarvester = $this->yield;
            $this->yield = 0;
            $this->isRipe = false;
        } else {
            $yieldToHarvester = 0;
        }
        return ['yield' => $yieldToHarvester, 'type' => $this->type];
    }

    private function calculateProductivity()
    {
        $productivityInfo = self::$productivityInfo;
        $type = $this->type;
        if ($productivityInfo[$type]) {
            return rand($productivityInfo[$type]['min'], $productivityInfo[$type]['max']);
        }
        throw new \Exception('Invalid tree type. No information about productivity is available');
    }

    public static function fromState($state)
    {
        $tree = new self($state['type']);
        $tree->isRipe = $state['is_ripe'];
        $tree->yield = $state['yield'];
        $tree->id = $state['id'];
        return $tree;
    }
}