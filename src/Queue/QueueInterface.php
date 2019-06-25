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

namespace Vain\Core\Queue;

use Vain\Core\Queue\Message\QueueMessageInterface;

/**
 * Interface QueueInterface
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
interface QueueInterface
{
    /**
     * @return QueueInterface
     */
    public function subscribe() : QueueInterface;

    /**
     * @return QueueInterface
     */
    public function unSubscribe() : QueueInterface;

    /**
     * @param QueueMessageInterface $queueMessage
     *
     * @return QueueInterface
     */
    public function enqueue(QueueMessageInterface $queueMessage) : QueueInterface;

    /**
     * @return QueueMessageInterface
     */
    public function dequeue() : ?QueueMessageInterface;

    /**
     * @param QueueMessageInterface $queueMessage
     *
     * @return bool
     */
    public function confirm(QueueMessageInterface $queueMessage) : bool;
}
