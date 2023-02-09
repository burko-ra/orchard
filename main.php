<?php

require __DIR__ . '/vendor/autoload.php';

use Orchard\Orchard;
use Orchard\Harvester;

//Определяем условия - сколько деревьев каждого вида
$trees = [
    ['type' => 'apple tree', 'quantity' => 10],
    ['type' => 'pear tree', 'quantity' => 15]
    ];


$orchard = new Orchard();
print("Инициализирован объект - фруктовый сад\n");

foreach ($trees as $treeInfo) {
    $quantity = $treeInfo['quantity'];
    $type = $treeInfo['type'];

    for ($i = 0; $i < $quantity; $i += 1) {
        $orchard->addTree($type);
    }
}
print("Добавлены деревья в количестве, указанном в условии\n");
print($orchard . "\n\n");

$harvester = new Harvester();
print("Инициализирован объект - сборщик фруктов\n");

$treesToHarvest = $orchard->getTrees();
foreach ($treesToHarvest as $tree) {
    $harvester->harvest($tree);
}
print("Фрукты собраны\n");
print($harvester . "\n\n");

//Согласно условиям задачи, у каждого дерева свой id
$thatTree = $orchard->getTreeById(8);