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

namespace Vain\Core\Api\Config\Parameter\Filter;

use Vain\Core\Api\Config\Parameter\Result\ApiConfigParameterFailedResult;
use Vain\Core\Api\Config\Parameter\Result\ApiConfigParameterResultInterface;
use Vain\Core\Api\Config\Parameter\Result\ApiConfigParameterSuccessfulResult;

/**
 * Class ApiConfigParameterDecimalFilter
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class ApiConfigParameterDecimalFilter extends AbstractApiConfigParameterFilter
{
    private $precision;

    private $scale;

    /**
     * ApiConfigParameterDecimalFilter constructor.
     *
     * @param int $precision
     * @param int $scale
     */
    public function __construct(int $precision, int $scale)
    {
        $this->precision = $precision;
        $this->scale = $scale;
    }

    /**
     * @inheritDoc
     */
    public function doFilter(string $name, $element): ApiConfigParameterResultInterface
    {
        if (null === ($decimal = filter_var($element, FILTER_SANITIZE_STRING, FILTER_NULL_ON_FAILURE))) {
            return new ApiConfigParameterFailedResult(sprintf('Parameter %s is not a valida decimal', $name));
        }

        return new ApiConfigParameterSuccessfulResult($decimal);
    }
}
