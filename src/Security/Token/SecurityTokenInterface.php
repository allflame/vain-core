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

namespace Vain\Core\Security\Token;

use Vain\Core\Api\Resource\ApiResourceInterface;
use Vain\Core\PrivateX\PrivateInterface;
use Vain\Core\Security\OAuth\Client\OAuthClientInterface;
use Vain\Core\Security\User\SecurityUserInterface;
use Vain\Core\String\StringInterface;

/**
 * Interface SecurityTokenInterface
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
interface SecurityTokenInterface extends
    ApiResourceInterface,
    PrivateInterface,
    StringInterface
{
    /**
     * @return bool
     */
    public function isExpired() : bool;

    /**
     * @return SecurityUserInterface
     */
    public function getUser(): SecurityUserInterface;

    /**
     * @return OAuthClientInterface
     */
    public function getClient();

    /**
     * @param string $resource
     * @param string $scope
     *
     * @return bool
     */
    public function hasPermission(string $resource, string $scope) : bool;
}
