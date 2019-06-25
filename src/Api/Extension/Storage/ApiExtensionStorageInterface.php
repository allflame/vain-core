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
 * Interface ApiExtensionStorageInterface
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
interface ApiExtensionStorageInterface
{
    /**
     * @param string $path
     * @param string $namespace
     *
     * @return ApiExtensionStorageInterface
     */
    public function addPath(string $path, string $namespace) : ApiExtensionStorageInterface;

    /**
     * @return array
     */
    public function getPaths() : array;
}