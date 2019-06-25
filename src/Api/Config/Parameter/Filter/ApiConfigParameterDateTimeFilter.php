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
declare(strict_types=1);

namespace Vain\Core\Api\Config\Parameter\Filter;

use Vain\Core\Api\Config\Parameter\Result\ApiConfigParameterResultInterface;
use Vain\Core\Api\Config\Parameter\Result\ApiConfigParameterSuccessfulResult;
use Vain\Core\Api\Config\Parameter\Result\ApiParameterWrongTypeResult;
use Vain\Core\Time\Factory\TimeFactoryInterface;

/**
 * Class ApiConfigParameterDateTimeFilter
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class ApiConfigParameterDateTimeFilter extends AbstractApiConfigParameterFilter
{
    private $timeFactory;

    /**
     * ApiValidatorDateTimeModule constructor.
     *
     * @param TimeFactoryInterface $timeFactory
     * @param bool                 $isOptional
     * @param mixed                $default
     */
    public function __construct(TimeFactoryInterface $timeFactory, $isOptional = false, $default = null)
    {
        $this->timeFactory = $timeFactory;
        parent::__construct($isOptional, $default);
    }

    /**
     * @inheritDoc
     */
    public function doFilter(string $name, $element): ApiConfigParameterResultInterface
    {
        if (null === ($dateTime = filter_var(
                $element,
                FILTER_SANITIZE_STRING,
                ['flags' => FILTER_FLAG_EMPTY_STRING_NULL | FILTER_NULL_ON_FAILURE]
            ))
        ) {
            return new ApiParameterWrongTypeResult($name, 'time string', $element);
        }

        return new ApiConfigParameterSuccessfulResult($this->timeFactory->createFromString($dateTime));
    }
}
