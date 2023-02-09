<?php

namespace Orchard\Tests;

use Orchard\Orchard;
use Orchard\Trees\AppleTree;
use Orchard\Trees\PearTree;
use PHPUnit\Framework\TestCase;

class OrchardTest extends TestCase
{
    private Orchard $orchard;

    public function setUp(): void
    {
        $this->orchard = new Orchard();
    }
    public function testCreateObjectOfGivenType(): void
    {
        $type1 = 'apple tree';
        $appleTree = $this->orchard->addTree($type1);
        $this->assertInstanceOf(AppleTree::class, $appleTree);

        $type2 = 'pear tree';
        $pearTree = $this->orchard->addTree($type2);
        $this->assertInstanceOf(PearTree::class, $pearTree);
    }

    public function testIdCounter(): void
    {
        /**
         * @var AppleTree
         */
        $newTree = $this->orchard->addTree('apple tree');
        $this->assertEquals(1, $newTree->getId());

        /**
         * @var PearTree
         */
        $tree2 = $this->orchard->addTree('pear tree');
        $this->assertEquals(2, $tree2->getId());
    }

    public function testGetTreeById(): void
    {
        $tree1 = $this->orchard->addTree('pear tree');
        /**
         * @var AppleTree
         */
        $tree2 = $this->orchard->addTree('apple tree');
        $tree3 = $this->orchard->addTree('pear tree');

        $findedTree = $this->orchard->getTreeById($tree2->getId());
        $this->assertEquals($tree2, $findedTree);
    }

    public function testGetTreesSummary(): void
    {
        $trees = [
            ['type' => 'apple tree', 'quantity' => 8],
            ['type' => 'pear tree', 'quantity' => 11]
        ];

        foreach ($trees as $treeInfo) {
            $quantity = $treeInfo['quantity'];
            $type = $treeInfo['type'];
        
            for ($i = 0; $i < $quantity; $i += 1) {
                $this->orchard->addTree($type);
            }
        }

        $expectedSummary = ['apple tree' => 8, 'pear tree' => 11];

        $this->assertEquals($expectedSummary, $this->orchard->getTreesSummary());
    }
}