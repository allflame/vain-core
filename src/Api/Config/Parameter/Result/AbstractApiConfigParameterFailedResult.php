<?php
/**
 * Vain Framework
 *
 * PHP Version 7
 *
 * @package   vain-core
 * @license   https://opensource.org/licenses/MIT MIT License
 * @link      https://github.com/allflame/vain-core
 */
declare(strict_types = 1);

namespace Vain\Core\Api\Config\Parameter\Result;

use Vain\Core\Result\AbstractFailedResult;

/**
 * Class AbstractApiConfigParameterFailedResult
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
abstract class AbstractApiConfigParameterFailedResult extends AbstractFailedResult implements
    ApiConfigParameterResultInterface
{
    private $name;

    /**
     * AbstractApiConfigParameterFailedResult constructor.
     *
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
        parent::__construct();
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @inheritDoc
     */
    public function getValue()
    {
        return null;
    }

    /**
     * @inheritDoc
     */
    public function toDisplay(): array
    {
        return ['status' => false, 'name' => $this->name, 'code' => 422];
    }
}