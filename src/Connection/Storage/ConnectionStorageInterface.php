<?php
/**
 * Vain Framework
 *
 * PHP Version 7
 *
 * @package   vain-database
 * @license   https://opensource.org/licenses/MIT MIT License
 * @link      https://github.com/allflame/vain-database
 */
declare(strict_types = 1);

namespace Vain\Core\Connection\Storage;

use Vain\Core\Connection\Factory\ConnectionFactoryInterface;

/**
 * Interface ConnectionStorageInterface
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
interface ConnectionStorageInterface
{
    /**
     * @param ConnectionFactoryInterface $connectionFactory
     *
     * @return ConnectionStorageInterface
     */
    public function addFactory(ConnectionFactoryInterface $connectionFactory) : ConnectionStorageInterface;

    /**
     * @param string $connectionName
     *
     * @return mixed
     */
    public function getConnection(string $connectionName);
}
