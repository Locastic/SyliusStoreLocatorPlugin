<?php

declare(strict_types=1);

namespace Locastic\SyliusStoreLocatorPlugin\Menu;

use Sylius\Bundle\UiBundle\Menu\Event\MenuBuilderEvent;

final class AdminMenuListener
{
    public function addAdminMenuItems(MenuBuilderEvent $event): void
    {
        $menu = $event->getMenu();

        $newSubmenu = $menu
            ->addChild('locastic_sylius_store_locator_plugin')
            ->setLabel('locastic_sylius_store_locator_plugin.ui.store_locator');

        $newSubmenu
            ->addChild(
                'stores',
                [
                    'route' => 'locastic_sylius_store_locator_plugin_admin_store_index',
                ]
            )
            ->setLabel('locastic_sylius_store_locator_plugin.ui.stores')
            ->setLabelAttribute('icon', 'map marker alternate');
    }
}