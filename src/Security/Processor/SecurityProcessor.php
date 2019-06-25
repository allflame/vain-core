<?php
/**
 * Vain Framework
 *
 * PHP Version 7
 *
 * @package   vain-security
 * @license   https://opensource.org/licenses/MIT MIT License
 * @link      https://github.com/allflame/vain-security
 */
declare(strict_types=1);

namespace Vain\Core\Security\Processor;

use Psr\Http\Message\ServerRequestInterface;
use Vain\Core\Security\Config\SecurityConfigInterface;
use Vain\Core\Security\Context\SecurityContextInterface;
use Vain\Core\Security\Processor\Strategy\Storage\SecurityProcessorStrategyStorageInterface;
use Vain\Core\Security\Token\Storage\SecurityTokenStorageInterface;

/**
 * Class SecurityProcessor
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class SecurityProcessor implements SecurityProcessorInterface
{
    private $tokenStorage;

    private $securityContext;

    private $strategyStorage;

    /**
     * SecurityProcessor constructor.
     *
     * @param SecurityTokenStorageInterface             $tokenStorage
     * @param SecurityContextInterface                  $securityContext
     * @param SecurityProcessorStrategyStorageInterface $strategyStorage
     */
    public function __construct(
        SecurityTokenStorageInterface $tokenStorage,
        SecurityContextInterface $securityContext,
        SecurityProcessorStrategyStorageInterface $strategyStorage
    ) {
        $this->tokenStorage = $tokenStorage;
        $this->securityContext = $securityContext;
        $this->strategyStorage = $strategyStorage;
    }

    /**
     * @inheritDoc
     */
    public function isAllowed(SecurityConfigInterface $securityConfig, ServerRequestInterface $request): bool
    {
        if (null === ($token = $this->tokenStorage->getProvider($securityConfig->getAuth())->getToken($request))) {
            return false;
        }
        $this->securityContext->setToken($token);

        if (false === $securityConfig->isEnabled()) {
            return true;
        }

        if ($token->isExpired()) {
            return false;
        }

        if (false === $token->hasPermission($securityConfig->getResource(), $securityConfig->getScope())) {
            return false;
        }

        return $this->strategyStorage
            ->getStrategy($securityConfig->getStrategy())
            ->decide($securityConfig->getAccessControls(), $token, $request);
    }
}
