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
declare(strict_types = 1);

namespace Vain\Core\Security\Processor\Strategy;

use Psr\Http\Message\ServerRequestInterface;
use Vain\Core\Security\Access\Storage\AccessControlStorageInterface;
use Vain\Core\Security\Token\SecurityTokenInterface;

/**
 * Class SecurityProcessorDenyStrategy
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class SecurityProcessorDenyStrategy extends AbstractSecurityProcessorStrategy
{
    /**
     * SecurityProcessorAllowStrategy constructor.
     *
     * @param AccessControlStorageInterface $accessControlStorage
     */
    public function __construct(AccessControlStorageInterface $accessControlStorage)
    {
        parent::__construct('deny', $accessControlStorage);
    }

    /**
     * @inheritDoc
     */
    public function decide(
        array $accessControls,
        SecurityTokenInterface $token,
        ServerRequestInterface $request
    ) : bool
    {
        foreach ($accessControls as $accessControl) {
            if (false === $this->checkSingle($accessControl['name'], $accessControl['config'], $token, $request)) {
                return false;
            }
        }

        return true;
    }
}
