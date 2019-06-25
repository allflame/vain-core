<?php
/**
 * Vain Framework
 *
 * PHP Version 7
 *
 * @package   vain-config
 * @license   https://opensource.org/licenses/MIT MIT License
 * @link      https://github.com/allflame/vain-config
 */
declare(strict_types=1);

namespace Vain\Core\Config\Data\Handler\RequireX;

use Vain\Core\Config\Data\Handler\HandlerInterface;

/**
 * Class RequireHandler
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class RequireHandler implements HandlerInterface
{
    private $cachePath;

    private $configDir;

    private $env;

    private $mode;

    private $fileName;


    /**
     * RequireHandler constructor.
     *
     * @param string $cachePath
     * @param string $configDir
     * @param string $env
     * @param string $mode
     * @param string $fileName
     */
    public function __construct(string $cachePath, string $configDir, string $env, string $mode, string $fileName)
    {
        $this->cachePath = $cachePath;
        $this->configDir = $configDir;
        $this->fileName = $fileName;
        $this->env = $env;
        $this->mode = $mode;
    }

    /**
     * @return string
     */
    public function getFullName(): string
    {
        return sprintf(
            '%s%s%s%s%s',
            $this->cachePath,
            $this->configDir,
            DIRECTORY_SEPARATOR,
            md5($this->fileName . '*' . $this->mode . '*' . $this->env),
            '.php'
        );
    }

    /**
     * @inheritdoc
     */
    public function read()
    {
        $fullName = $this->getFullName();
        if (false === file_exists($fullName)) {
            return null;
        }

        return require_once($fullName);
    }

    /**
     * @inheritdoc
     */
    public function write(array $data): bool
    {
        $fullName = $this->getFullName();
        $contents = sprintf('<?php return %s;', var_export($data, true));
        if (false === file_exists(dirname($fullName))) {
            mkdir(dirname($fullName), 0755, true);
        }
        if (false === file_put_contents($fullName, $contents)) {
            return false;
        }

        return true;
    }
}
