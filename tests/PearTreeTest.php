<?php

namespace Orchard\Tests;

use Orchard\Orchard;
use Orchard\Trees\PearTree;
use PHPUnit\Framework\TestCase;

class PearTreeTest extends TestCase
{
    public function testGiveYield(): void
    {
        $orchard = new Orchard();
        /**
         * @var PearTree
         */
        $tree = $orchard->addTree('pear tree');
        $tree->giveYield();
        $this->assertEquals(0, $tree->getYield());
    }
}
