<?php

require __DIR__ . '/vendor/autoload.php';

use Orchard\Orchard;
use Orchard\Harvester;

//Определяем условия - сколько деревьев каждого вида
$trees = [
    ['type' => 'apple tree', 'quantity' => 10],
    ['type' => 'pear tree', 'quantity' => 15]
    ];

//Инициализируем фруктовый сад (Orchard)
$orchard = new Orchard();

//Добавляем деревья
foreach ($trees as $treeInfo) {
    $quantity = $treeInfo['quantity'];
    $type = $treeInfo['type'];

    for ($i = 0; $i < $quantity; $i += 1) {
        $orchard->addTree($type);
    }
}
print($orchard . "\n");

//Инициализируем сборщик фруктов (Harvester)
$harvester = new Harvester();

//Собираем фрукты
$treesToHarvest = $orchard->getTrees();
foreach ($treesToHarvest as $tree) {
    $harvester->harvest($tree);
}
print($harvester);

//Находим дерево по id
var_dump($orchard->getTreeById(8));