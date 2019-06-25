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

namespace Vain\Core\Entity\Operation;

use Vain\Core\Entity\EntityInterface;
use Vain\Core\Entity\Event\UpdateEntityEvent;
use Vain\Core\Entity\Result\CannotUpdateEntityResult;
use Vain\Core\Event\Dispatcher\EventDispatcherInterface;
use Vain\Core\Event\Resolver\EventResolverInterface;
use Vain\Core\Operation\AbstractOperation;
use Vain\Core\Result\ResultInterface;
use Vain\Core\Result\SuccessfulResult;

/**
 * Class AbstractUpdateEntityOperation
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
abstract class AbstractUpdateEntityOperation extends AbstractOperation
{
    private $eventResolver;

    private $eventDispatcher;

    /**
     * AbstractCreateEntityOperation constructor.
     *
     * @param EventResolverInterface   $eventResolver
     * @param EventDispatcherInterface $eventDispatcher
     */
    public function __construct(EventResolverInterface $eventResolver, EventDispatcherInterface $eventDispatcher)
    {
        $this->eventResolver = $eventResolver;
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * @return EntityInterface
     */
    abstract public function getNewEntity() : EntityInterface;

    /**
     * @return EntityInterface
     */
    abstract public function getOldEntity() : EntityInterface;

    /**
     * @param EntityInterface $newEntity
     * @param EntityInterface $oldEntity
     *
     * @return EntityInterface
     */
    abstract public function updateEntity(EntityInterface $newEntity, EntityInterface $oldEntity) : EntityInterface;

    /**
     * @inheritDoc
     */
    public function execute() : ResultInterface
    {
        if (null === ($newEntity = $this->getNewEntity())) {
            return new CannotUpdateEntityResult($newEntity);
        }

        if (null === ($oldEntity = $this->getOldEntity())) {
            return new CannotUpdateEntityResult($newEntity);
        }

        if (null === ($this->updateEntity($newEntity, $oldEntity))) {
            return new CannotUpdateEntityResult($newEntity);
        }

        $this->eventDispatcher
            ->dispatch(
                new UpdateEntityEvent(
                    $this->eventResolver->createName('entity', 'update'),
                    $newEntity,
                    $oldEntity
                )
            )
            ->dispatch(
                new UpdateEntityEvent(
                    $this->eventResolver->createName($newEntity->getEntityName(), 'update'),
                    $newEntity,
                    $oldEntity
                )
            );

        return new SuccessfulResult();
    }
}
