<?php
/**
 * Vain Framework
 *
 * PHP Version 7
 *
 * @package   vain-http
 * @license   https://opensource.org/licenses/MIT MIT License
 * @link      https://github.com/allflame/vain-http
 */
declare(strict_types = 1);

namespace Vain\Core\Http\Response;

use Vain\Core\Http\Header\Storage\HeaderStorageInterface;
use Vain\Core\Http\Message\AbstractMessage;
use Vain\Core\Http\Stream\VainStreamInterface;

/**
 * Class AbstractResponse
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
abstract class AbstractResponse extends AbstractMessage implements VainResponseInterface
{
    private $code;

    private $message;

    /**
     * AbstractResponse constructor.
     *
     * @param int                    $code
     * @param VainStreamInterface    $stream
     * @param HeaderStorageInterface $headerStorage
     */
    public function __construct(int $code, VainStreamInterface $stream, HeaderStorageInterface $headerStorage)
    {
        $this->code = $code;
        parent::__construct($stream, $headerStorage);
    }

    /**
     * @inheritDoc
     */
    public function getStatusCode(): int
    {
        return $this->code;
    }

    /**
     * @inheritDoc
     */
    public function withStatus($code, $reasonPhrase = ''): VainResponseInterface
    {
        if (false === array_key_exists($code, self::CODE_TO_MESSAGE)) {
            $code = 500;
        }
        if ('' === $reasonPhrase) {
            $reasonPhrase = self::CODE_TO_MESSAGE[$code];
        }
        $copy = clone $this;
        $copy->code = $code;
        $copy->message = $reasonPhrase;

        return $copy;
    }

    /**
     * @inheritDoc
     */
    public function getReasonPhrase(): string
    {
        if (null !== $this->message) {
            return $this->message;
        }

        if (false === array_key_exists($this->code, self::CODE_TO_MESSAGE)) {
            return '';
        }

        return self::CODE_TO_MESSAGE[$this->code];
    }

    /**
     * @inheritDoc
     */
    public function toDisplay(): array
    {
        return array_merge([sprintf('%d %s', $this->getStatusCode(), $this->getReasonPhrase())], parent::toDisplay());
    }
}