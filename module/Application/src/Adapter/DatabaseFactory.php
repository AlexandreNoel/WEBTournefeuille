<?php
/**
 * Created by PhpStorm.
 * User: theo
 * Date: 21/10/18
 * Time: 17:48
 */
namespace Application\Adapter;
/**
 * Class DatabaseFactory
 * @package Application\Adapter
 */
class DatabaseFactory
{
    public function getDbAdapter(): \PDO
    {
        /** @var array $config */
        $config = include __DIR__ . '/../../config/module.config.php';
        $dbh = 'pgsql:user='.$config['database']['user'].';dbname='.$config['database']['dbname'].';password='.$config['database']['password'];
        return new \PDO($dbh);
    }
}