<?php

require __DIR__ . '/vendor/autoload.php';

use Orchard\Database;
use Orchard\Harvester;
use Orchard\Orchard;
use Orchard\PrinterForHarvester;
use Orchard\Repositories\TreeRepository;

$orchard = new Orchard();
$db = new Database();
$treeRepository = new TreeRepository($db);
$harvester = new Harvester();

$trees = [
    ['type' => 'apple tree', 'quantity' => 10],
    ['type' => 'pear tree', 'quantity' => 15]
    ];

//Добавление деревьев
foreach ($trees as $treeType) {
    $quantity = $treeType['quantity'];
    for ($i = 0; $i < $quantity; $i += 1) {
        $tree = $orchard->addTree($treeType['type']);
        $tree->produceYield();
        $treeRepository->save($tree);
    }
}

//Сбор плодов
$treesToHarvest = $treeRepository->getAll();
array_map(function($item) use ($harvester) {
    $harvester->harvest($item);
}, $treesToHarvest);

//Выдача информации о собранных плодах
PrinterForHarvester::print($harvester->getCargo());
