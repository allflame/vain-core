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

namespace Vain\Core\Api\Request\Validator\Result;

use Vain\Core\Api\Request\ApiRequestInterface;
use Vain\Core\Result\ResultInterface;

/**
 * Interface ApiRequestValidatorResultInterface
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
interface ApiValidatorResultInterface extends ResultInterface
{
    /**
     * @return ApiRequestInterface
     */
    public function getRequest() : ApiRequestInterface;
}
