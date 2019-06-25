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
declare(strict_types = 1);

namespace Vain\Core\Queue\Event\Storage;

use Vain\Core\Event\EventInterface;
use Vain\Core\Event\Handler\AbstractEventHandler;
use Vain\Core\Event\Resolver\EventResolverInterface;

/**
 * Class EventStorage
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class EventStorage extends AbstractEventHandler implements EventStorageInterface
{
    private $events = [];

    /**
     * EventStorage constructor.
     *
     * @param EventResolverInterface $resolver
     */
    public function __construct(EventResolverInterface $resolver)
    {
        parent::__construct($resolver);
    }

    /**
     * @param EventInterface $event
     *
     * @return EventStorage
     */
    public function onResponse(EventInterface $event) : EventStorage
    {
        $this->events = [];

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function trackEvent(EventInterface $event) : bool
    {
        if (array_key_exists(spl_object_hash($event), $this->events)) {
            return false;
        }

        return true;
    }
}
