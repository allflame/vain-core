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

use Vain\Core\Connection\ConnectionInterface;
use Vain\Core\Exception\UnknownQueueMessageException;
use Vain\Core\Queue\Message\Factory\Storage\QueueMessageFactoryStorageInterface;
use Vain\Core\Queue\Message\QueueMessageInterface;

/**
 * Class AbstractQueue
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
abstract class AbstractQueue implements QueueInterface
{
    private $connection;

    private $factoryStorage;

    private $configData;

    /**
     * @var AbstractQueue $queue
     */
    private $queue;

    private $messages;

    /**
     * AbstractQueue constructor.
     *
     * @param ConnectionInterface                 $connection
     * @param QueueMessageFactoryStorageInterface $factoryStorage
     * @param array                               $configData
     */
    public function __construct(
        ConnectionInterface $connection,
        QueueMessageFactoryStorageInterface $factoryStorage,
        array $configData = []
    ) {
        $this->connection = $connection;
        $this->factoryStorage = $factoryStorage;
        $this->configData = $configData;
    }

    /**
     * @return ConnectionInterface
     */
    public function getConnection(): ConnectionInterface
    {
        return $this->connection;
    }

    /**
     * @return QueueMessageFactoryStorageInterface
     */
    public function getFactoryStorage(): QueueMessageFactoryStorageInterface
    {
        return $this->factoryStorage;
    }

    /**
     * @return array
     */
    public function getConfigData(): array
    {
        return $this->configData;
    }

    /**
     * @return mixed
     */
    public function getQueue()
    {
        if (!$this->queue) {
            $this->queue = $this->connection->establish();
        }

        return $this->queue;
    }

    /**
     * @return array
     */
    public function getMessages()
    {
        return $this->messages;
    }

    /**
     * @param array $configData
     *
     * @return mixed
     */
    abstract public function doSubscribe(array $configData);

    /**
     * @param QueueMessageInterface $queueMessage
     *
     * @return bool
     */
    abstract public function doConfirm(QueueMessageInterface $queueMessage) : bool;

    /**
     * @return QueueMessageInterface
     */
    abstract public function doDequeue() : ?QueueMessageInterface;

    /**
     * @inheritDoc
     */
    public function dequeue() : ?QueueMessageInterface
    {
        if (null === ($queueMessage = $this->doDequeue())) {
            return null;
        }

        $this->messages[$queueMessage->getId()] = $queueMessage;

        return $queueMessage;
    }

    /**
     * @inheritDoc
     */
    public function subscribe() : QueueInterface
    {
        if (null === $this->queue) {
            $this->queue = $this->doSubscribe($this->configData);
        }

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function confirm(QueueMessageInterface $queueMessage) : bool
    {
        $messageId = $queueMessage->getId();
        if (false === array_key_exists($messageId, $this->messages)) {
            throw new UnknownQueueMessageException($this, $queueMessage);
        }

        if (false === $this->doConfirm($queueMessage)) {
            return false;
        }

        unset($this->messages[$messageId]);

        return true;
    }
}
