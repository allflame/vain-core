<?php
/**
 * Vain Framework
 *
 * PHP Version 7
 *
 * @package   vain-time
 * @license   https://opensource.org/licenses/MIT MIT License
 * @link      https://github.com/allflame/vain-time
 */
declare(strict_types = 1);

namespace Vain\Core\Time\Provider;

use Vain\Core\Time\Factory\TimeFactoryInterface;
use Vain\Core\Time\TimeInterface;

/**
 * Class TimeProvider
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class TimeProvider implements TimeProviderInterface
{
    private $timeFactory;

    /**
     * TimeProvider constructor.
     *
     * @param TimeFactoryInterface $timeFactory
     */
    public function __construct(TimeFactoryInterface $timeFactory)
    {
        $this->timeFactory = $timeFactory;
    }

    /**
     * @inheritDoc
     */
    public function getCurrentTime(string $timeZone) : TimeInterface
    {
        return $this->timeFactory->createFromString('now', $timeZone);
    }
}