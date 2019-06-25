<?php
/**
 * Vain Framework
 *
 * PHP Version 7
 *
 * @package   vain-entity
 * @license   https://opensource.org/licenses/MIT MIT License
 * @link      https://github.com/allflame/vain-entity
 */
declare(strict_types = 1);

namespace Vain\Core\Entity\Event;

use Vain\Core\Entity\EntityInterface;

/**
 * Interface EntityEventInterface
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
interface EntityEventInterface
{
    /**
     * @return EntityInterface
     */
    public function getEntity() : EntityInterface;

    public function isForceProceed(): bool;

    public function setForceProceed(bool $forceProceed);
}
