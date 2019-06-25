<?php
/**
 * Vain Framework
 *
 * PHP Version 7
 *
 * @package   vain-core
 * @license   https://opensource.org/licenses/MIT MIT License
 * @link      https://github.com/allflame/vain-core
 */
declare(strict_types = 1);

namespace Vain\Core\Exception;

/**
 * Class AbstractCoreException
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
abstract class AbstractCoreException extends \Exception implements CoreExceptionInterface
{
    /**
     * AbstractCoreException constructor.
     *
     * @param string          $message
     * @param int             $code
     * @param \Exception|null $previous
     */
    public function __construct(string $message, int $code = 500, \Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize() : array
    {
        return ['status' => false, 'code' => $this->getCode(), 'message' => $this->getMessage()];
    }
}
