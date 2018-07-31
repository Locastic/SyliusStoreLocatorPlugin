<?php

declare(strict_types=1);

namespace Locastic\SyliusStoreLocatorPlugin\Fixture;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Sylius\Bundle\CoreBundle\Fixture\ShippingMethodFixture as BaseShippingMethodFixture;

class ShippingMethodFixture extends BaseShippingMethodFixture
{
    protected function configureResourceNode(ArrayNodeDefinition $resourceNode): void
    {
        parent::configureResourceNode($resourceNode);

        $resourceNode
            ->children()
                ->booleanNode('is_pickup_at_store')->end();
    }
}
