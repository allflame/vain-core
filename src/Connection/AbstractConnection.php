<?php
/**
 * Vain Framework
 *
 * PHP Version 7
 *
 * @package   vain-core
 * @license   https://opensource.org/licenses/MIT MIT License
 * @link      https://github.com/allflame/vain-core
 */
declare(strict_types = 1);

namespace Vain\Core\Connection;

/**
 * Class AbstractConnection
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
abstract class AbstractConnection implements ConnectionInterface
{
    private $connectionInstance;

    private $configData;

    private $connectionName;

    /**
     * AbstractConnection constructor.
     *
     * @param \ArrayAccess $configData
     * @param string       $connectionName
     */
    public function __construct(\ArrayAccess $configData, string $connectionName)
    {
        $this->configData = $configData;
        $this->connectionName = $connectionName;
    }

    /**
     * @inheritDoc
     */
    public function getName() : string
    {
        return $this->connectionName;
    }

    /**
     * @return array
     */
    public function getConfigData() : array
    {
        return $this->configData['connections'][$this->connectionName];
    }

    /**
     * @return mixed
     */
    abstract public function doEstablish();

    /**
     * @inheritDoc
     */
    public function establish()
    {
        if (null === $this->connectionInstance) {
            $this->connectionInstance = $this->doEstablish();
        }

        return $this->connectionInstance;
    }
}