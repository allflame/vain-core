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

namespace Vain\Core\Exception;

use Vain\Core\Api\Config\Provider\ApiConfigProviderInterface;

/**
 * Class UnknownRouteException
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class UnknownRouteException extends ConfigProviderException
{
    private $endpointName;

    /**
     * UnknownRouteException constructor.
     *
     * @param ApiConfigProviderInterface $apiConfigProvider
     * @param string                     $endpointName
     */
    public function __construct(ApiConfigProviderInterface $apiConfigProvider, string $endpointName)
    {
        $this->endpointName = $endpointName;
        parent::__construct($apiConfigProvider, sprintf('Route %s not found', $endpointName), 404);
    }
}
