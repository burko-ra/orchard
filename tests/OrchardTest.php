<?php

namespace Orchard\Tests;

use Orchard\Orchard;
use Orchard\Trees\AppleTree;
use Orchard\Trees\PearTree;
use PHPUnit\Framework\TestCase;

class OrchardTest extends TestCase
{
    public function testAddTree(): void
    {
        $orchard = new Orchard();
        $type1 = 'apple tree';
        $appleTree = $orchard->addTree($type1);
        $this->assertInstanceOf(AppleTree::class, $appleTree);

        $type2 = 'pear tree';
        $pearTree = $orchard->addTree($type2);
        $this->assertInstanceOf(PearTree::class, $pearTree);
    }
}