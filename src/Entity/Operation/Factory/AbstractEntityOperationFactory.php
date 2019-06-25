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

namespace Vain\Core\Entity\Operation\Factory;

use Vain\Core\Entity\EntityInterface;
use Vain\Core\Operation\Factory\Decorator\AbstractOperationFactoryDecorator;
use Vain\Core\Operation\OperationInterface;

/**
 * Class AbstractEntityOperationFactory
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
abstract class AbstractEntityOperationFactory extends AbstractOperationFactoryDecorator implements
    EntityOperationFactoryInterface
{

    /**
     * @param EntityInterface $newEntity
     * @param EntityInterface $oldEntity
     *
     * @return OperationInterface
     */
    abstract public function doUpdateOperation(
        EntityInterface $newEntity,
        EntityInterface $oldEntity
    ) : OperationInterface;

    /**
     * @inheritDoc
     */
    public function updateOperation(EntityInterface $newEntity, EntityInterface $oldEntity) : OperationInterface
    {
        return $this->doUpdateOperation($newEntity, $oldEntity);
    }
}
