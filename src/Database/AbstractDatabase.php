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

namespace Vain\Core\Database;

use Vain\Core\Connection\ConnectionInterface;
use Vain\Core\Database\Cursor\DatabaseCursorInterface;
use Vain\Core\Database\Generator\DatabaseGeneratorInterface;
use Vain\Core\Database\Generator\Factory\DatabaseGeneratorFactoryInterface;

/**
 * Class AbstractDatabase
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
abstract class AbstractDatabase implements DatabaseInterface
{
    private $generatorFactory;

    private $connection;

    /**
     * AbstractDatabase constructor.
     *
     * @param DatabaseGeneratorFactoryInterface $generatorFactory
     * @param ConnectionInterface               $connection
     */
    public function __construct(
        DatabaseGeneratorFactoryInterface $generatorFactory,
        ConnectionInterface $connection
    ) {
        $this->generatorFactory = $generatorFactory;
        $this->connection = $connection;
    }

    /**
     * @return mixed
     */
    public function getConnection()
    {
        return $this->connection->establish();
    }

    /**
     * @param DatabaseCursorInterface $databaseCursor
     *
     * @return DatabaseGeneratorInterface
     */
    public function getGenerator(DatabaseCursorInterface $databaseCursor) : DatabaseGeneratorInterface
    {
        return $this->generatorFactory->create($databaseCursor);
    }
}
