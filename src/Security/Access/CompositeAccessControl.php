<?php
/**
 * Vainyl
 *
 * PHP Version 7
 *
 * @package   Vain-core
 * @license   https://opensource.org/licenses/MIT MIT License
 * @link      https://vainyl.com
 */
declare(strict_types=1);

namespace Vain\Core\Security\Access;

use Psr\Http\Message\ServerRequestInterface;
use Vain\Core\Security\Processor\Strategy\Storage\SecurityProcessorStrategyStorageInterface;
use Vain\Core\Security\Token\SecurityTokenInterface;

/**
 * Class CompositeAccessControl
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class CompositeAccessControl extends AbstractAccessControl
{
    private $storage;

    /**
     * CompositeAccessControl constructor.
     *
     * @param SecurityProcessorStrategyStorageInterface $storage
     */
    public function __construct(SecurityProcessorStrategyStorageInterface $storage)
    {
        $this->storage = $storage;
    }

    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return 'composite';
    }

    /**
     * @inheritDoc
     */
    public function doIsAllowed(
        array $accessConfigData,
        SecurityTokenInterface $token,
        ServerRequestInterface $request
    ): bool {
        return $this->storage
            ->getStrategy($accessConfigData['strategy'])
            ->decide(
                $accessConfigData['configs'],
                $token,
                $request
            );
    }
}