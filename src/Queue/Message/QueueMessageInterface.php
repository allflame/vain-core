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

namespace Vain\Core\Queue\Message;

use Vain\Core\ArrayX\ArrayInterface;
use Vain\Core\Event\EventInterface;

/**
 * Interface QueueMessageInterface
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
interface QueueMessageInterface extends ArrayInterface
{
    /**
     * @return string
     */
    public function getId() : string;

    /**
     * @return string
     */
    public function getSource() : string;

    /**
     * @return string
     */
    public function getDestination() : string;

    public function getContent() : EventInterface;
}
