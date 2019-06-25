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

namespace Vain\Core\Security\Voter\Strategy;

use Vain\Core\Api\Resource\ApiResourceInterface;
use Vain\Core\Security\Token\SecurityTokenInterface;

/**
 * Class SecurityVoterAllowStrategy
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class SecurityVoterAllowStrategy extends AbstractSecurityVoterStrategy
{
    /**
     * @inheritDoc
     */
    public function getName() : string
    {
        return 'allow';
    }

    /**
     * @inheritDoc
     */
    public function decide(array $voterConfigs, SecurityTokenInterface $token, ApiResourceInterface $resource) : bool
    {
        foreach ($voterConfigs as $voterConfig) {
            if (1 === $this->checkSingle($voterConfig['name'], $voterConfig['config'], $token, $resource)) {
                return true;
            }
        }

        return false;
    }
}
