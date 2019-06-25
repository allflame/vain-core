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

namespace Vain\Core\Api\Request;

use Psr\Http\Message\ServerRequestInterface;
use Vain\Core\Api\Resource\ApiResourceInterface;
use Vain\Core\Display\DisplayableInterface;

/**
 * Interface ApiRequestInterface
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
interface ApiRequestInterface extends DisplayableInterface, ServerRequestInterface, ApiResourceInterface
{
    /**
     * @return string
     */
    public function getId() : string;

    /**
     * @param string $parameter
     *
     * @return bool
     */
    public function hasParameter(string $parameter) : bool;

    /**
     * @param string $parameter
     *
     * @return mixed
     */
    public function getParameter(string $parameter);

    /**
     * @return array
     */
    public function getParameters() : array;
}