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

namespace Vain\Core\Extension\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Class ApiParameterSourceCompilerPass
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class ApiParameterSourceCompilerPass implements CompilerPassInterface
{
    /**
     * @inheritDoc
     */
    public function process(ContainerBuilder $container)
    {
        if (false === $container->has('api.parameter.source.factory.storage')) {
            return $this;
        }

        $definition = $container->findDefinition('api.parameter.source.factory.storage');
        $services = $container->findTaggedServiceIds('source.factory');
        foreach ($services as $id => $tags) {
            $definition->addMethodCall('addItem', [new Reference($id)]);
        }

        return $this;
    }
}
