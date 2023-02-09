<?php

namespace Orchard\Tests;

use Orchard\Orchard;
use Orchard\Trees\AppleTree;
use PHPUnit\Framework\TestCase;

class AppleTreeTest extends TestCase
{
    public function testGiveYield(): void
    {
        $orchard = new Orchard();
        /**
         * @var AppleTree
         */
        $tree = $orchard->addTree('apple tree');
        $tree->giveYield();
        $this->assertEquals(0, $tree->getYield());
    }
}
