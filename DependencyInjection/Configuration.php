<?php

namespace Doctrs\StoredProcedureBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * @return TreeBuilder
     *
     * @throws \RuntimeException
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('stored_procedure');

        $rootNode
            ->children()
            ->arrayNode('connections')
            ->isRequired()
            ->cannotBeEmpty()
            ->useAttributeAsKey('name')
            ->arrayPrototype()
            ->end()
            ->end()
        ;

        return $treeBuilder;
    }
<<<<<<< HEAD
}
=======
}
>>>>>>> a3da2e33642080d9ede805ee5c0ec403d45c4167
