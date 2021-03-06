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

use Vain\Core\Connection\ConnectionInterface;
use Vain\Core\Name\Storage\AbstractNameableStorage;

/**
 * Class ConnectionStorage
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 *
 * @method ConnectionInterface getItem(string $connectionName)
 */
class ConnectionStorage extends AbstractNameableStorage implements ConnectionStorageInterface
{
    /**
     * @inheritDoc
     */
    public function getConnection(string $connectionName) : ConnectionInterface
    {
        return $this->getItem($connectionName);
    }
}
