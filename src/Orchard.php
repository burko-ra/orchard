<?php

namespace Orchard;

use Orchard\Trees\AppleTree;
use Orchard\Trees\PearTree;
use Orchard\Trees\Tree;

class Orchard
{
    /**
     * @var array<mixed>
     */
    private $trees = [];
    private int $idCounter = 0;
    /**
     * @var array<mixed>
     */
    private static $dictionary = [
        'apple tree' => AppleTree::class,
        'pear tree' => PearTree::class,
    ];

    public function addTree(string $type): object
    {
        $id = $this->getNextId();
        $class = self::$dictionary[$type];
        $tree = new $class($id);
        $this->trees[$id] = $tree;
        return $tree;
    }

    private function getNextId(): int
    {
        $this->idCounter += 1;
        return $this->idCounter;
    }

    /**
     * @return array<int,object>
     */
    public function getTrees()
    {
        return $this->trees;
    }

    public function getTreeById(int $id): object
    {
        return $this->trees[$id];
    }

    /**
     * @return array<string,int>
     */
    public function getTreesSummary()
    {
        $trees = $this->trees;
        $mappedTrees = array_map(fn($item) => $item->getType(), $trees);
        return array_reduce($mappedTrees, function ($acc, $item) {
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
