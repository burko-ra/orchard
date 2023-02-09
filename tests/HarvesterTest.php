<?php

namespace Orchard\Tests;

use Orchard\Harvester;
use Orchard\Orchard;
use Orchard\Trees\AppleTree;
use PHPUnit\Framework\TestCase;

class HarvesterTest extends TestCase
{
    public function testCargo(): void
    {
        $orchard = new Orchard();
        $harvester = new Harvester();

        /**
         * @var AppleTree
         */
        $tree = $orchard->addTree('apple tree');
        $expectedCargo = [$tree->getType() => $tree->getYield()];
        $harvester->harvest($tree);
        $this->assertEquals($expectedCargo, $harvester->getCargo());
    }
}
