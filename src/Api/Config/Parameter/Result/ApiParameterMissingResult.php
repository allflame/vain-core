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
 * Interface ApiConfigParameterMissingResult
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class ApiParameterMissingResult extends AbstractApiConfigParameterFailedResult
{
    /**
     * @return string
     */
    public function __toString(): string
    {
        return sprintf('Required parameter %s is missing', $this->getName());
    }

    /**
     * @return array
     */
    public function toDisplay(): array
    {
        return array_merge(['message' => $this->__toString()], parent::toDisplay());
    }
}