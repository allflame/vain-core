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

namespace Vain\Core\Security\Voter\Decorator\Assert;

use Psr\Http\Message\ServerRequestInterface;
use Vain\Core\Security\Access\Decorator\AbstractAccessControlDecorator;
use Vain\Core\Exception\NoRequiredFieldAccessControlException;
use Vain\Core\Security\Token\SecurityTokenInterface;

/**
 * Class VoterAccessControlAssertDecorator
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class VoterAccessControlAssertDecorator extends AbstractAccessControlDecorator
{
    /**
     * @inheritDoc
     */
    public function isAllowed(
        array $accessConfigData,
        SecurityTokenInterface $token,
        ServerRequestInterface $request
    ) : bool
    {
        foreach (['voters', 'strategy', 'resource'] as $requiredField) {
            if (false === array_key_exists($requiredField, $accessConfigData)) {
                throw new NoRequiredFieldAccessControlException($this, $this->getName(), $requiredField);
            }
        }

        return parent::isAllowed($accessConfigData, $token, $request);
    }
}
