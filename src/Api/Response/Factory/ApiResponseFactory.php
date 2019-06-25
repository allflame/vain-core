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

namespace Vain\Core\Api\Response\Factory;

use Vain\Core\Api\Request\ApiRequestInterface;
use Vain\Core\Api\Response\ApiResponse;
use Vain\Core\Api\Response\ApiResponseInterface;

/**
 * Class ApiResponseFactory
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class ApiResponseFactory implements ApiResponseFactoryInterface
{
    /**
     * @inheritDoc
     */
    public function createSuccessful(int $status, array $data = [], array $headers = []) : ApiResponseInterface
    {
        return $this->createFromData($status, '', $data, $headers);
    }

    /**
     * @inheritDoc
     */
    public function createFailed(
        int $status,
        string $shortMessage = '',
        array $data = [],
        array $headers = []
    ) : ApiResponseInterface
    {
        return $this->createFromData($status, $shortMessage, $data, $headers);
    }

    /**
     * @inheritDoc
     */
    public function createFromData(
        int $status,
        string $shortMessage = '',
        array $data = [],
        array $headers = []
    ) : ApiResponseInterface
    {
        return new ApiResponse($status, $shortMessage, $data, $headers);
    }

    /**
     * @inheritDoc
     */
    public function createAccessDeniedResponse(ApiRequestInterface $apiRequest) : ApiResponseInterface
    {
        return $this->createFailed(401);
    }

    /**
     * @inheritDoc
     */
    public function createDuplicationResponse(ApiRequestInterface $apiRequest) : ApiResponseInterface
    {
        return $this->createFailed(400);
    }

}