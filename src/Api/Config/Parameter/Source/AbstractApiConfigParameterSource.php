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

namespace Vain\Core\Api\Config\Parameter\Source;

use Vain\Core\Api\Config\Parameter\Result\ApiParameterMissingResult;
use Vain\Core\Api\Config\Parameter\Result\ApiConfigParameterResultInterface;
use Vain\Core\Api\Config\Parameter\Result\ApiConfigParameterSuccessfulResult;

/**
 * Class AbstractApiConfigParameterSource
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
abstract class AbstractApiConfigParameterSource implements ApiConfigParameterSourceInterface
{
    private $source;

    private $destination;

    private $isOptional;

    private $defaultValue;

    /**
     * AbstractApiParameterConfigSourceModule constructor.
     *
     * @param string $source
     * @param string $destination
     * @param bool   $isOptional
     * @param mixed  $defaultValue
     */
    public function __construct(string $source, string $destination, bool $isOptional = false, $defaultValue = null)
    {
        $this->source = $source;
        $this->destination = $destination;
        $this->isOptional = $isOptional;
        $this->defaultValue = $defaultValue;
    }

    /**
     * @param array $data
     *
     * @return ApiConfigParameterResultInterface
     */
    public function process(array $data): ApiConfigParameterResultInterface
    {
        if (array_key_exists($this->source, $data)) {
            return new ApiConfigParameterSuccessfulResult([$this->destination => $data[$this->source]]);
        }

        if ($this->isOptional) {
            return new ApiConfigParameterSuccessfulResult([$this->destination => $this->defaultValue]);
        }

        if ('*' === $this->source) {
            return new ApiConfigParameterSuccessfulResult($data);
        }

        return new ApiParameterMissingResult($this->source);
    }
}