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

namespace Vain\Core\Api\Request;

use Psr\Http\Message\ServerRequestInterface;
use Vain\Core\Api\Request\ApiRequestInterface;
use Vain\Core\Equal\EquatableInterface;
use Vain\Core\Http\Request\Decorator\AbstractServerRequestDecorator;
use Vain\Core\Security\User\SecurityUserInterface;

/**
 * Class ApiRequest
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class ApiRequest extends AbstractServerRequestDecorator implements ApiRequestInterface
{
    private $id;

    private $parsedParameters;

    /**
     * AbstractApiRequest constructor.
     *
     * @param string                 $id
     * @param array                  $parsedParameters
     * @param ServerRequestInterface $serverRequest
     */
    public function __construct(string $id, ServerRequestInterface $serverRequest, array $parsedParameters = [])
    {
        $this->id = $id;
        $this->parsedParameters = $parsedParameters;
        parent::__construct($serverRequest);
    }

    /**
     * @inheritDoc
     */
    public function equals(EquatableInterface $equatable): bool
    {
        return false;
    }

    /**
     * @inheritDoc
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @inheritDoc
     */
    public function getParameter(string $parameter)
    {
        if (false === $this->hasParameter($parameter)) {
            return null;
        }

        return $this->parsedParameters[$parameter];
    }

    /**
     * @inheritDoc
     */
    public function getParameters(): array
    {
        return $this->parsedParameters;
    }

    /**
     * @inheritDoc
     */
    public function hasParameter(string $parameter): bool
    {
        return array_key_exists($parameter, $this->parsedParameters);
    }

    /**
     * @inheritDoc
     */
    public function isConformedTo(SecurityUserInterface $user): bool
    {
        return false;
    }

    /**
     * @inheritDoc
     */
    public function isOwnedBy(SecurityUserInterface $user): bool
    {
        return false;
    }

    /**
     * @inheritDoc
     */
    public function toDisplay(): array
    {
        return ['id' => $this->id, 'parameters' => $this->parsedParameters];
    }
}
