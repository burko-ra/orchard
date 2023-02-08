<?php

namespace Orchard\Repositories;

use Orchard\Database;
use Orchard\FruitTree;

class TreeRepository
{
    private $db;

    public function __construct(Database $database)
    {
        $this->db = $database;
    }

    public function save(FruitTree $tree)
    {
        $sql = "INSERT INTO trees (type_id, is_ripe, yield) VALUES
            ((SELECT id FROM tree_types WHERE name = :type), :is_ripe, :yield)";

        $params = [
            ':type' => $tree->getType(),
            ':is_ripe' => $tree->checkIsRipe(),
            ':yield' => $tree->getYield(),
        ];

        return $this->db->insert($sql, $params);
    }

    public function getById(string $id)
    {
        $sql = "SELECT
            trees.id,
            tree_types.name as type,
            is_ripe,
            yield
        FROM trees
        JOIN tree_types
        ON trees.type_id = tree_types.id
        WHERE trees.id = :id;";
        $row = $this->db->getRow($sql, [':id' => $id]);
        return $this->transformRowToObject($row);
    }

    public function getAll()
    {
        $sql = "SELECT
            trees.id,
            tree_types.name as type,
            is_ripe,
            yield
        FROM trees
        JOIN tree_types
        ON trees.type_id = tree_types.id";
        $rows = $this->db->getAll($sql);
        return array_map(function($row) {
            return $this->transformRowToObject($row);
        }, $rows);
    }

    public function update(FruitTree $tree)
    {
        $sql = "UPDATE trees
        SET
            is_ripe = :is_ripe,
            yield = :yield
        WHERE id = :id;";

        $params = [
            ':is_ripe' => $tree->checkIsRipe(),
            ':yield' => $tree->getYield(),
            ':id' => $tree->getId()
        ];

        return $this->db->update($sql, $params);
    }

    private function transformRowToObject($row)
    {
        $row['is_ripe'] = (bool) $row['is_ripe'];
        return FruitTree::fromState($row);
    }
}
