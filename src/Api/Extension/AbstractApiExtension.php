<?php
/**
 * Vain Framework
 *
 * PHP Version 7
 *
 * @package   vain-api
 * @license   https://opensource.org/licenses/MIT MIT License
 * @link      https://github.com/allflame/vain-api
 */
declare(strict_types=1);

namespace Vain\Core\Api\Extension;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

/**
 * Class AbstractApiExtension
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
abstract class AbstractApiExtension extends Extension
{
    /**
     * @inheritDoc
     */
    public function load(array $configs, ContainerBuilder $container): AbstractApiExtension
    {
        $reflectionClass = new \ReflectionClass($this);
        $absolutePath = dirname($reflectionClass->getFileName(), 2);

        $loader = new YamlFileLoader($container, new FileLocator($absolutePath));
        $loader->load('di.yml');

        if (false === $container->has('api.config.composite') || false === $container->hasParameter('app.dir')) {
            return $this;
        }

        $appDir = $container->getParameter('app.dir');
        if (false === strpos($absolutePath, $appDir)) {
            return $this;
        }

        if (substr($absolutePath, strlen($appDir)) . DIRECTORY_SEPARATOR . 'api') {
            $container
                ->findDefinition('api.config.composite')
                ->addMethodCall(
                    'addFile',
                    [substr($absolutePath, strlen($appDir)) . DIRECTORY_SEPARATOR . 'api']
                );
        }

        $entityDir = $absolutePath . DIRECTORY_SEPARATOR . 'Entity';
        if ($container->has('api.extension.entity.storage') && is_dir($entityDir)) {
            $container
                ->findDefinition('api.extension.entity.storage')
                ->addMethodCall(
                    'addPath',
                    [
                        $entityDir,
                        str_replace('\Extension', '\Entity', $reflectionClass->getNamespaceName()),
                    ]
                );
        }

        $documentDir = $absolutePath . DIRECTORY_SEPARATOR . 'Document';
        if ($container->has('api.extension.document.storage') && is_dir($documentDir)) {
            $container
                ->findDefinition('api.extension.document.storage')
                ->addMethodCall(
                    'addPath',
                    [
                        $documentDir,
                        str_replace('\Extension', '\Document', $reflectionClass->getNamespaceName()),
                    ]
                );

        }
        return $this;
    }
}
