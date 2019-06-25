<?php
/**
 * Vain Framework
 *
 * PHP Version 7
 *
 * @package   vain-cache
 * @license   https://opensource.org/licenses/MIT MIT License
 * @link      https://github.com/allflame/vain-cache
 */
declare(strict_types = 1);

namespace Vain\Core\Cache;

/**
 * Interface CacheInterface
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
interface CacheInterface
{
    /**
     * @param string $key
     * @param mixed  $value
     * @param int    $ttl
     *
     * @return bool
     */
    public function set(string $key, $value, int $ttl = 0) : bool;

    /**
     * @param string $key
     * @param mixed  $value
     * @param int    $ttl
     *
     * @return bool
     */
    public function add(string $key, $value, int $ttl) : bool;

    /**
     * @param string $key
     *
     * @return mixed
     */
    public function get(string $key);

    /**
     * @param string $key
     *
     * @return bool
     */
    public function del(string $key) : bool;

    /**
     * @param string $key
     *
     * @return bool
     */
    public function has(string $key) : bool;

    /**
     * @param string $key
     * @param int    $ttl
     *
     * @return bool
     */
    public function expire(string $key, int $ttl) : bool;
}
