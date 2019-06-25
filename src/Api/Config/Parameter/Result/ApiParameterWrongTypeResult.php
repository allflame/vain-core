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

namespace Vain\Core\Api\Config\Parameter\Result;

/**
 * Class ApiConfigParameterWrongTypeResult
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class ApiParameterWrongTypeResult extends AbstractApiConfigParameterFailedResult
{
    private $expected;

    private $actualValue;

    /**
     * ApiConfigParameterWrongTypeResult constructor.
     *
     * @param string $name
     * @param string $expected
     * @param        $actualValue
     */
    public function __construct(string $name, string $expected, $actualValue)
    {
        $this->expected = $expected;
        $this->actualValue = $actualValue;
        parent::__construct($name);
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return sprintf(
            'Parameter %s [%s] is not an %s',
            $this->getName(),
            $this->expected,
            var_export($this->actualValue, true)
        );
    }

    /**
     * @return array
     */
    public function toDisplay(): array
    {
        return array_merge(
            ['expected' => $this->expected, 'actual' => gettype($this->actualValue), 'message' => $this->__toString()],
            parent::toDisplay()
        );
    }
}