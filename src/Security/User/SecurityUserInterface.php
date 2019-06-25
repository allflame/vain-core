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

namespace Vain\Core\Security\User;

use Vain\Core\Display\DisplayableInterface;
use Vain\Core\Equal\EquatableInterface;
use Vain\Core\PrivateX\PrivateInterface;
use Vain\Core\Security\Role\SecurityRoleInterface;
use Vain\Core\String\StringInterface;

/**
 * Interface SecurityUserInterface
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
interface SecurityUserInterface extends
    DisplayableInterface,
    PrivateInterface,
    EquatableInterface,
    StringInterface
{
    /**
     * @param SecurityRoleInterface $role
     *
     * @return bool
     */
    public function hasRole(SecurityRoleInterface $role) : bool;

    /**
     * @return SecurityRoleInterface[]
     */
    public function getRoles() : array;

    /**
     * @return SecurityUserInterface[]
     */
    public function getSubordinates() : array;
}
