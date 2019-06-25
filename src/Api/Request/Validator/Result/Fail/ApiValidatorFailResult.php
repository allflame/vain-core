<?php
/**
 * Vain Framework
 *
 * PHP Version 7
 *
 * @package   vain-api
 * @license   https://opensource.org/licenses/MIT MIT License
 * @link      https://github.com/allflame/vain-api
 */
declare(strict_types = 1);

namespace Vain\Core\Api\Request\Validator\Result\Fail;

use Vain\Core\Api\Request\ApiRequestInterface;
use Vain\Core\Api\Request\Validator\Result\ApiValidatorResultInterface;
use Vain\Core\Result\AbstractFailedResult;

/**
 * Class ApiValidatorFailResult
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class ApiValidatorFailResult extends AbstractFailedResult implements ApiValidatorResultInterface
{
    private $data;

    /**
     * ApiRequestValidatorFailResult constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
        parent::__construct();
    }

    /**
     * @inheritDoc
     */
    public function getRequest(): ApiRequestInterface
    {
        return null;
    }

    /**
     * @inheritDoc
     */
    public function toDisplay(): array
    {
        return $this->data;
    }

    /**
     * @inheritDoc
     */
    public function __toString(): string
    {
        return implode(', ', $this->data);
    }
}
