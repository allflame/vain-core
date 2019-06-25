<?php
/**
 * Vain Framework
 *
 * PHP Version 7
 *
 * @package   vain-http
 * @license   https://opensource.org/licenses/MIT MIT License
 * @link      https://github.com/allflame/vain-http
 */
declare(strict_types=1);

namespace Vain\Core\Http\Application\Decorator\Exception;

use Vain\Core\Exception\AbstractCoreException;
use Vain\Core\Http\Application\Decorator\AbstractHttpApplicationDecorator;
use Vain\Core\Http\Application\HttpApplicationInterface;
use Vain\Core\Http\Request\VainServerRequestInterface;
use Vain\Core\Http\Response\Factory\ResponseFactoryInterface;
use Vain\Core\Http\Response\VainResponseInterface;
use Vain\Logger\LoggerInterface;

/**
 * Class ExceptionApplicationDecorator
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class ExceptionApplicationDecorator extends AbstractHttpApplicationDecorator
{
    private $responseFactory;

    private $logger;

    /**
     * ExceptionApplicationDecorator constructor.
     *
     * @param HttpApplicationInterface $application
     * @param ResponseFactoryInterface $responseFactory
     */
    public function __construct(HttpApplicationInterface $application, ResponseFactoryInterface $responseFactory, LoggerInterface $logger = null)
    {
        $this->responseFactory = $responseFactory;
        $this->logger = $logger;
        parent::__construct($application);
    }

    /**
     * @inheritDoc
     */
    public function handleRequest(VainServerRequestInterface $request): VainResponseInterface
    {
        try {
            $response = parent::handleRequest($request);
        } catch (AbstractCoreException $e) {
            $this->logger->error($e->getMessage() . "\n" . $e->getTraceAsString());
            $response = $this->responseFactory
                ->createResponse(
                    'php://temp',
                    $e->getCode(),
                    [],
                    json_encode($e)
                )
                ->withContentType(VainResponseInterface::CONTENT_TYPE_APPLICATION_JSON)
                ->withStatus($e->getCode(), $e->getMessage());
        } catch (\Throwable $e) {
            $this->logger->critical($e->getMessage() . "\n" . $e->getTraceAsString());
            $response = $this->responseFactory
                ->createResponse(
                    'php://temp',
                    $e->getCode(),
                    [],
                    json_encode(
                        [
                          'status' => false,
                          'code' => $e->getCode(),
                          'message' => $e->getMessage(),
                          'stack' => $e->getTrace()
                        ]
                    )
                )
                ->withContentType(VainResponseInterface::CONTENT_TYPE_APPLICATION_JSON)
                ->withStatus($e->getCode(), $e->getMessage());
        }

        return $response;
    }
}
