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
 * Class SecurityVoterConsensusStrategy
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class SecurityVoterConsensusStrategy extends AbstractSecurityVoterStrategy
{
    /**
     * @inheritDoc
     */
    public function getName() : string
    {
        return 'consensus';
    }

    /**
     * @inheritDoc
     */
    public function decide(array $voterConfigs, SecurityTokenInterface $token, ApiResourceInterface $resource) : bool
    {
        $positive = $negative = 0;
        foreach ($voterConfigs as $voterConfig) {
            switch ($this->checkSingle($voterConfig['name'], $voterConfig['config'], $token, $resource)) {
                case 0:
                    $negative++;
                    break;
                case 1:
                    $positive++;
                    break;
            }
        }

        return $positive > $negative;
    }
}
