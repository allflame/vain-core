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
 * Class SecurityProcessorConsensusStrategy
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class SecurityProcessorConsensusStrategy extends AbstractSecurityProcessorStrategy
{

    /**
     * SecurityProcessorAllowStrategy constructor.
     *
     * @param AccessControlStorageInterface $accessControlStorage
     */
    public function __construct(AccessControlStorageInterface $accessControlStorage)
    {
        parent::__construct('consensus', $accessControlStorage);
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
        $positive = $negative = 0;
        foreach ($accessControls as $accessControl) {
            switch ($this->checkSingle($accessControl['name'], $accessControl['config'], $token, $request)) {
                case false:
                    $negative++;
                    break;
                case true:
                    $positive++;
                    break;
            }
        }

        return $positive > $negative;
    }
}
