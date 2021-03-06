<?php
/**
 * Vain Framework
 *
 * PHP Version 7
 *
 * @package   vain-database
 * @license   https://opensource.org/licenses/MIT MIT License
 * @link      https://github.com/allflame/vain-database
 */
declare(strict_types = 1);

namespace Vain\Core\Extension\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Class ConnectionCompilerPass
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class ConnectionCompilerPass implements CompilerPassInterface
{
    /**
     * @inheritDoc
     */
    public function process(ContainerBuilder $container)
    {
        if (false === $container->has('connection.storage')) {
            return $this;
        }

        $definition = $container->findDefinition('connection.storage');
        $services = $container->findTaggedServiceIds('connection');
        foreach ($services as $id => $tags) {
            $definition->addMethodCall('addItem', [new Reference($id)]);
        }

        return $this;
    }
}
