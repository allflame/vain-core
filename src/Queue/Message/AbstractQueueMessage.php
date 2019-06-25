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

use Vain\Core\Event\EventInterface;

/**
 * Class AbstractQueueMessage
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
abstract class AbstractQueueMessage implements QueueMessageInterface
{
    private $id;

    private $type;

    private $source;

    private $destination;

    private $content;

    /**
     * AbstractQueueMessage constructor.
     *
     * @param string         $type
     * @param string         $id
     * @param string         $source
     * @param string         $destination
     * @param EventInterface $content
     */
    public function __construct(string $type, string $id, string $source, string $destination, EventInterface $content)
    {
        $this->id = $id;
        $this->type = $type;
        $this->source = $source;
        $this->destination = $destination;
        $this->content = $content;
    }

    /**
     * @inheritDoc
     */
    public function toArray() : array
    {
        return [
            'id'          => $this->id,
            'type'        => $this->type,
            'source'      => $this->source,
            'destination' => $this->destination,
            'content'     => serialize($this->content),
        ];
    }

    /**
     * @inheritDoc
     */
    public function getId() : string
    {
        return $this->id;
    }

    /**
     * @inheritDoc
     */
    public function getSource() : string
    {
        return $this->source;
    }

    /**
     * @inheritDoc
     */
    public function getDestination() : string
    {
        return $this->destination;
    }

    public function getContent() : EventInterface
    {
        return $this->content;
    }
}
