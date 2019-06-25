<?php
/**
 * Vain Framework
 *
 * PHP Version 7
 *
 * @package   vain-queue
 * @license   https://opensource.org/licenses/MIT MIT License
 * @link      https://github.com/allflame/vain-queue
 */

namespace Vain\Core\Queue\Event\Handler\Decorator\Queue;

use Vain\Core\Entity\Event\EntityEventInterface;
use Vain\Core\Event\Config\EventConfigInterface;
use Vain\Core\Event\EventInterface;
use Vain\Core\Event\Handler\Decorator\AbstractEventHandlerDecorator;
use Vain\Core\Event\Handler\EventHandlerInterface;

/**
 * Class EventHandlerQueueDecorator
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class EventHandlerQueueDecorator extends AbstractEventHandlerDecorator
{
    private $queueHandler;

    /**
     * HandlerQueueDecorator constructor.
     *
     * @param EventHandlerInterface $eventHandler
     * @param EventHandlerInterface $queueHandler
     */
    public function __construct(EventHandlerInterface $eventHandler, EventHandlerInterface $queueHandler)
    {
        $this->queueHandler = $queueHandler;
        parent::__construct($eventHandler);
    }

    /**
     * @inheritDoc
     */
    public function handle(EventInterface $event, EventConfigInterface $eventConfig) : EventHandlerInterface
    {
        $forceProceed = $event instanceof EntityEventInterface && $event->isForceProceed();

        if (!$forceProceed && false === $eventConfig->isForeground()) {
            $this->queueHandler->handle($event, $eventConfig);

            return $this;
        }

        return parent::handle($event, $eventConfig);
    }
}
