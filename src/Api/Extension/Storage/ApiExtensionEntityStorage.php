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

namespace Vain\Core\Api\Extension\Storage;

/**
 * Class ApiExtensionEntityStorage
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class ApiExtensionEntityStorage implements ApiExtensionStorageInterface
{
    private $paths = [];

    /**
     * @inheritDoc
     */
    public function addPath(string $path, string $namespace) : ApiExtensionStorageInterface
    {
        $this->paths[$path] = $namespace;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getPaths() : array
    {
        return $this->paths;
    }
}