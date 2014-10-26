<?php
namespace Doctrine\Common\DataFixtures\Executor;
/**
 * Created by PhpStorm.
 * User: Rafael
 * Date: 26/10/2014
 * Time: 08:24
 */
use Doctrine\Common\DataFixtures\Executor\AbstractExecutor;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\SharedFixtureInterface;
use Doctrine\DBAL\Connection;

class DoctrineDbalExecutor extends AbstractExecutor {

    /**
     * Construct new fixtures loader instance.
     *
     * @param Connection $db Connection instance used for persistence.
     */
    public function __construct(Connection $db, $purger = null)
    {
        $this->db = $db;
        if ($purger !== null) {
            $this->purger = $purger;
        }
    }

    /**
     * Executes the given array of data fixtures.
     *
     * @param array $fixtures Array of fixtures to execute.
     * @param boolean $append Whether to append the data fixtures or purge the database before loading.
     */
    public function execute(array $fixtures, $append = false)
    {
        if ($append === false) {
            $this->purge();
        }
        foreach ($fixtures as $fixture) {
            $this->load($this->db, $fixture);
        }
    }
}