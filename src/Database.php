<?php

namespace Orchard;

class Database
{
    public \PDO $dbh;

    public function __construct()
    {
        $dsn = "sqlite:database.sqlite";
        $this->dbh = new \PDO($dsn);

        $sql = "DELETE FROM trees;";
        $this->query($sql, []);
    }

    /**
     * @param array<mixed> $params
     * @return array<mixed>
     */
    public function getAll(string $sql, $params = [])
    {
        $sth = $this->query($sql, $params);
        return $sth->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * @param array<mixed> $params
     * @return array<mixed>
     */
    public function getRow(string $sql, $params = [])
    {
        $sth = $this->query($sql, $params);
        $res = $sth->fetch(\PDO::FETCH_ASSOC);

        if ($res === false) {
            throw new \Exception('Failed to get an array containing result row: ' . $this->dbh->errorInfo()[2]);
        }
        return $res;
    }

    /**
     * @param array<mixed> $params
     */
    public function insert(string $sql, $params = []): string
    {
        $this->query($sql, $params);
        $res = $this->dbh->lastInsertId();

        if ($res === false) {
            throw new \Exception('Failed to get the ID of the last inserted row: ' . $this->dbh->errorInfo()[2]);
        }
        return $res;
    }

    /**
     * @param array<mixed> $params
     * @return \PDOStatement
     */
    private function query(string $sql, $params = [])
    {
        $sth = $this->dbh->prepare($sql);
        $res = $sth->execute($params);

        if ($res === false) {
            throw new \Exception('Failed to execute the query: ' . $this->dbh->errorInfo()[2]);
        }
        return $sth;
    }

    /**
     * @param array<mixed> $params
     */
    public function update(string $sql, $params = []): void
    {
        $this->query($sql, $params);
    }
}
