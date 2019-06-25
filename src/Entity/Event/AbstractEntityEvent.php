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
use Vain\Core\Event\AbstractEvent;

/**
 * Class AbstractEntityEvent
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
abstract class AbstractEntityEvent extends AbstractEvent implements EntityEventInterface
{
    private $name;

    private $entity;

    private $forceProceed = false;

    /**
     * AbstractEntityEvent constructor.
     *
     * @param string          $name
     * @param EntityInterface $entity
     */
    public function __construct($name, EntityInterface $entity)
    {
        $this->name = $name;
        $this->entity = $entity;
    }

    /**
     * @inheritDoc
     */
    public function getName() : string
    {
        return $this->name;
    }

    /**
     * @inheritDoc
     */
    public function getEntity() : EntityInterface
    {
        return $this->entity;
    }

    /**
     * @return bool
     */
    public function isForceProceed(): bool
    {
        return $this->forceProceed;
    }

    /**
     * Force proceed event from queue
     *
     * @param bool $forceProceed
     */
    public function setForceProceed(bool $forceProceed)
    {
        $this->forceProceed = $forceProceed;
    }
}
