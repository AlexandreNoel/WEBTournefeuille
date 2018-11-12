<?php
namespace Adapter;
class DatabaseFactory{
    function getDbAdapter():\PDO
        {
            $dbName = getenv('DB_NAME');
            $dbUser = getenv('DB_USER');
            $dbPassword = getenv('DB_PASSWORD');
            $connection = "pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword";
            return new \PDO($connection);
        }
}
