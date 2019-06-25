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

namespace Vain\Core\Api\Request\Validator\Config;

use Psr\Http\Message\ServerRequestInterface;
use Vain\Core\Api\Config\ApiConfigInterface;
use Vain\Core\Api\Request\Factory\ApiRequestFactoryInterface;
use Vain\Core\Api\Request\Validator\AbstractApiValidator;
use Vain\Core\Api\Request\Validator\Result\ApiValidatorResultInterface;
use Vain\Core\Api\Request\Validator\Result\Fail\ApiValidatorFailResult;
use Vain\Core\Api\Request\Validator\Result\Successful\ApiValidatorSuccessfulResult;

/**
 * Class ApiConfigValidator
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class ApiConfigValidator extends AbstractApiValidator
{
    /**
     * ApiConfigValidator constructor.
     *
     * @param ApiRequestFactoryInterface $apiRequestFactory
     */
    public function __construct(ApiRequestFactoryInterface $apiRequestFactory)
    {
        parent::__construct($apiRequestFactory);
    }

    /**
     * @inheritDoc
     */
    public function validate(
        ServerRequestInterface $serverRequest,
        ApiConfigInterface $apiConfig
    ): ApiValidatorResultInterface {
        $processedValues = [];
        foreach ($apiConfig->getParameterConfigs() as $apiParameterConfig) {
            $result = $apiParameterConfig->handle($serverRequest);
            if (false === $result->isSuccessful()) {
                return new ApiValidatorFailResult($result->toDisplay());
            }

            $processedValues[] = $result->getValue();
        }

        $extractedValues = count($processedValues) > 0
            ? array_merge(...$processedValues)
            : [];

        return new ApiValidatorSuccessfulResult(
            $this->getApiRequestFactory()->createRequest($serverRequest, $extractedValues)
        );
    }
}
