<?php

namespace Adapter;

/**
 * Class DatabaseFactory
 * @package Application\Adapter
 */
class DatabaseFactory
{
    public function getDbAdapter(): \PDO
    {
        $dbName = getenv('DB_NAME');
        $dbUser = getenv('DB_USER');
        $dbPassword = getenv('DB_PASSWORD');
        $connection = new \PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");
        $connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        return $connection;
    }
}