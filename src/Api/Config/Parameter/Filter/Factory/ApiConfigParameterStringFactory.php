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

namespace Vain\Core\Api\Config\Parameter\Filter\Factory;

use Vain\Core\Api\Config\Parameter\Filter\ApiConfigParameterFilterInterface;
use Vain\Core\Api\Config\Parameter\Filter\ApiConfigParameterStringFilter;
use Vain\Core\Api\Config\Parameter\Filter\ApiConfigParameterUrlStringFilter;

/**
 * Class ApiConfigParameterStringFactory
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class ApiConfigParameterStringFactory implements ApiConfigParameterFilterFactoryInterface
{
    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return 'string';
    }

    /**
     * @inheritDoc
     */
    public function createFilter(array $config): ApiConfigParameterFilterInterface
    {
        if ($config['source'] === 'url') {
            return new ApiConfigParameterUrlStringFilter($config['optional'] ?? false, $config['default'] ?? null);
        } else {
            return new ApiConfigParameterStringFilter($config['optional'] ?? false, $config['default'] ?? null);
        }
    }
}
