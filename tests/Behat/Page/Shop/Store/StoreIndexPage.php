<?php

namespace Tests\Locastic\SyliusStoreLocatorPlugin\Behat\Page\Shop\Store;

use Behat\Mink\Element\NodeElement;
use Sylius\Behat\Page\SymfonyPage;

class StoreIndexPage extends SymfonyPage implements StoreIndexPageInterface
{

    /**
     * {@inheritdoc}
     */
    public function getRouteName()
    {
        return 'locastic_sylius_store_locator_plugin_shop_store_index';
    }

    public function hasStoreMap()
    {
        return $this->getSession()->getPage()->find('css', '#map');

    }

    public function hasStorePreview($storeName)
    {
        $stores = $this->getSession()->getPage()->findAll('css', '.store-location');
        /** @var NodeElement $store */

        foreach ($stores as $store) {
            if (null !== $store->find('css', 'h3 a')) {
                $storeTitle = $store->find('css', 'h3 a');
                if($storeTitle->getText() === $storeName){
                    return true;
                }
            }
        }

        return false;
    }
}