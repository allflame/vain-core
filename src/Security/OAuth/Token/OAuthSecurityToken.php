<?php
/**
 * Vain Framework
 *
 * PHP Version 7
 *
 * @package   vain-security
 * @license   https://opensource.org/licenses/MIT MIT License
 * @link      https://github.com/allflame/vain-security
 */
declare(strict_types = 1);

namespace Vain\Core\Security\OAuth\Token;

use Vain\Core\Equal\EquatableInterface;
use Vain\Core\Security\OAuth\Client\OAuthClientInterface;
use Vain\Core\Api\Resource\AbstractApiResource;
use Vain\Core\Security\Token\SecurityTokenInterface;
use Vain\Core\Security\User\SecurityUserInterface;
use Vain\Core\Time\TimeInterface;

/**
 * Class OAuthSecurityToken
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class OAuthSecurityToken extends AbstractApiResource implements SecurityTokenInterface
{
    private $id;

    private $user;

    private $client;

    private $permissions;

    private $expiresAt;

    /**
     * OAuthSecurityToken constructor.
     *
     * @param string                    $id
     * @param SecurityUserInterface|null  $user
     * @param OAuthClientInterface|null $client
     * @param array                     $permissions
     * @param TimeInterface|null        $expiresAt
     */
    public function __construct(
        string $id,
        SecurityUserInterface $user = null,
        OAuthClientInterface $client = null,
        array $permissions = [],
        TimeInterface $expiresAt = null
    ) {
        $this->id = $id;
        $this->user = $user;
        $this->client = $client;
        $this->permissions = $permissions;
        $this->expiresAt = $expiresAt;
    }

    /**
     * @inheritDoc
     */
    public function getId() : string
    {
        return $this->id;
    }

    /**
     * @inheritDoc
     */
    public function getUser(): SecurityUserInterface
    {
        return $this->user;
    }

    /**
     * @return OAuthClientInterface
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @inheritDoc
     */
    public function isExpired() : bool
    {
        return (null !== $this->expiresAt) && ($this->expiresAt->getTimestamp() < time());
    }

    /**
     * @param array  $permissions
     * @param string $scope
     *
     * @return bool
     */
    protected function hasResourcePermission(array $permissions, string $scope) : bool
    {
        return (in_array('all', $permissions) || in_array($scope, $permissions));
    }

    /**
     * @param string $resource
     * @param string $scope
     *
     * @return bool
     */
    public function hasPermission(string $resource, string $scope) : bool
    {
        if (array_key_exists('all', $this->permissions)) {
            if ($this->hasResourcePermission($this->permissions['all'], $scope)) {
                return true;
            }
        }

        if (array_key_exists($resource, $this->permissions)) {
            if ($this->hasResourcePermission($this->permissions['all'], $scope)) {
                return true;
            }
        }

        return false;
    }

    /**
     * @inheritDoc
     */
    public function getOwner() : SecurityUserInterface
    {
        return $this->user;
    }

    /**
     * @inheritDoc
     */
    public function toDisplay() : array
    {
        return [
            'id'          => $this->id,
            'user'        => $this->user ? $this->user->toDisplay() : [],
            'client'      => $this->client ? $this->client->toDisplay() : [],
            'permissions' => $this->permissions,
            'expires_at'  => $this->expiresAt ? $this->expiresAt->toW3c() : null,
        ];
    }

    /**
     * @inheritDoc
     */
    public function equals(EquatableInterface $equatable) : bool
    {
        /**
         * @var SecurityTokenInterface $equatable
         */
        return $this->toDisplay() === $equatable->toDisplay();
    }

    /**
     * @inheritDoc
     */
    public function toPrivate() : array
    {
        return [
            'id'          => $this->id,
            'user'        => $this->user ? $this->user->toPrivate() : [],
            'client'      => $this->client ? $this->client->toPrivate() : [],
            'permissions' => $this->permissions,
            'expires_at'  => $this->expiresAt ? $this->expiresAt->toW3c() : null,
        ];
    }

    /**
     * @inheritDoc
     */
    public function __toString() : string
    {
        return $this->id;
    }
}
