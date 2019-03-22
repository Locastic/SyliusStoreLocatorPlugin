<?php
namespace Tests\Locastic\SyliusStoreLocatorPlugin\Behat\Page\Admin\Store;
use Sylius\Behat\Page\Admin\Crud\UpdatePage as BaseUpdatePage;

class UpdatePage extends BaseUpdatePage implements UpdatePageInterface
{
    /**
     * {@inheritdoc}
     */
    public function getRouteName()
    {
        return 'locastic_sylius_store_locator_plugin_admin_store_update';
    }
}