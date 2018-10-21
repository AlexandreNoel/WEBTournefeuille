<?php
/**
 * Created by PhpStorm.
 * User: theo
 * Date: 21/10/18
 * Time: 17:48
 */
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
        return $connection;
    }
}