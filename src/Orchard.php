<?php

namespace Orchard;

use Orchard\Trees\AppleTree;
use Orchard\Trees\PearTree;

class Orchard
{
    private $trees = [];
    private $idCounter = 0;
    private static $dictionary = [
        'apple tree' => AppleTree::class,
        'pear tree' => PearTree::class,
    ];

    public function addTree($type)
    {
        $id = $this->getNextId();
        $class = self::$dictionary[$type];
        $this->trees[$id] = new $class($id);
    }

    private function getNextId()
    {
        $this->idCounter += 1;
        return $this->idCounter;
    }

    public function getTrees()
    {
        return $this->trees;
    }

    public function getTreeById($id)
    {
        return $this->trees[$id];
    }

    public function getTreesSummary()
    {
        $trees = $this->trees;
        $mappedTrees = array_map(fn($item) => $item->getType(), $trees);
        return array_reduce($mappedTrees, function($acc, $item) {
            $acc[$item] = ($acc[$item] ?? 0) + 1;
            return $acc;
        }, []);
    }

    public function __toString()
    {
        $summary = $this->getTreesSummary();
        $lines = array_map(
            fn($key, $value) => "{$value} units of {$key}",
            array_keys($summary),
            $summary
        );
        $firstPart = $summary ? "The orchard contains: " : "The orchard contains no trees";

        return $firstPart . implode(", ", array_merge($lines)) . '.';
    }
}
