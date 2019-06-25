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

namespace Vain\Core\Queue\Event\Tracker;

use Vain\Core\Event\EventInterface;

/**
 * Class EventTracker
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class EventTracker implements EventTrackerInterface
{
    private $events = [];

    /**
     * @inheritDoc
     */
    public function resetEvents() : EventTrackerInterface
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
