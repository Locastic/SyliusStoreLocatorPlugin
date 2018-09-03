<?php

declare(strict_types=1);

namespace Locastic\SyliusStoreLocatorPlugin\Fixture;

use Sylius\Bundle\CoreBundle\Fixture\AbstractResourceFixture;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

class ShippingMethodFixture extends AbstractResourceFixture
{
    public function getName(): string
    {
        return 'app_shipping_method';
    }

    protected function configureResourceNode(ArrayNodeDefinition $resourceNode): void
    {
        $resourceNode
            ->children()
            ->scalarNode('code')->cannotBeEmpty()->end()
            ->scalarNode('name')->cannotBeEmpty()->end()
            ->scalarNode('description')->cannotBeEmpty()->end()
            ->scalarNode('zone')->cannotBeEmpty()->end()
            ->booleanNode('enabled')->end()
            ->scalarNode('category')->end()
            ->arrayNode('channels')->scalarPrototype()->end()->end()
            ->arrayNode('calculator')
                ->children()
                    ->scalarNode('type')->isRequired()->cannotBeEmpty()->end()
                    ->variableNode('configuration')->end()
                ->end()
            ->end()
            ->booleanNode('is_pickup_at_store')->end()
        ;
    }
}
