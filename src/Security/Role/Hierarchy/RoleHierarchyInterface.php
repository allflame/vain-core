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

namespace Vain\Core\Security\Role\Hierarchy;

use Vain\Core\Security\Role\SecurityRoleInterface;

/**
 * Interface RoleHierarchyInterface
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
interface RoleHierarchyInterface
{
    /**
     * @param string $roleName
     *
     * @return array
     */
    public function getRoleNames(string $roleName) : array;

    /**
     * @param string $roleName
     *
     * @return SecurityRoleInterface[]
     */
    public function getChildRoles(string $roleName) : array;

    /**
     * @param string $from
     * @param string $to
     *
     * @return bool
     */
    public function isReachable(string $from, string $to) : bool;
}
