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

namespace Vain\Core\Queue\Message\Factory;

use Vain\Core\Event\EventInterface;
use Vain\Core\Queue\Message\QueueMessageInterface;

/**
 * Interface QueueMessageFactoryInterface
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
interface QueueMessageFactoryInterface
{
    /**
     * @return string
     */
    public function getName() : string;

    /**
     * @param string         $source
     * @param string         $destination
     * @param EventInterface $content
     *
     * @return QueueMessageInterface
     */
    public function createMessage(string $source, string $destination, EventInterface $content) : QueueMessageInterface;

    /**
     * @param array $serializedMessage
     *
     * @return QueueMessageInterface
     */
    public function createFromArray(array $serializedMessage) : QueueMessageInterface;
}
