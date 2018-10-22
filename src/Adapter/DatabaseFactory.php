<?php

namespace Adapter;

/*
Class DatabaseFactory
Allow to get a connection easily
*/
class DatabaseFactory
{
    /**
     * get the connection
     * @return \PDO
     */
    public function getDbAdapter(): \PDO
    {
        $dbName = getenv('DB_NAME');
        $dbUser = getenv('DB_USER');
        $dbPassword = getenv('DB_PASSWORD');
        $connection = new \PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");
        return $connection;
    }

}
