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

/**
 * Class ApiConfigParameterUrlStringFilter
 *
 * @author Nazar Ivanenko <nivanenko@gmail.com>
 */
class ApiConfigParameterUrlStringFilter extends AbstractApiConfigParameterFilter
{
    /**
     * @inheritDoc
     */
    public function doFilter(string $name, $element): ApiConfigParameterResultInterface
    {
        if (false === ($string = filter_var(
                urldecode((string)$element),
                FILTER_SANITIZE_STRING,
                ['flags' => FILTER_FLAG_EMPTY_STRING_NULL]
            ))
        ) {
            return new ApiParameterWrongTypeResult($name, 'string', $element);
        }

        return new ApiConfigParameterSuccessfulResult($string);
    }
}
