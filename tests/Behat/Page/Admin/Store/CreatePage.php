<?php

namespace Tests\Locastic\SyliusStoreLocatorPlugin\Behat\Page\Admin\Store;

use Sylius\Behat\Page\Admin\Crud\CreatePage as BaseCreatePage;

class CreatePage extends BaseCreatePage implements CreatePageInterface
{

    /**
     * {@inheritdoc}
     */
    public function getRouteName()
    {
        return 'locastic_sylius_store_locator_plugin_admin_store_create';
    }

    /**
     * {@inheritdoc}
     */
    public function specifyCode($code)
    {
        $this->getDocument()->fillField('Code', $code);
    }

    /*public function open(array $urlParameters = [])
    {
        dump($this->getUrl($urlParameters));
        $this->getSession()->visit($this->getUrl($urlParameters));
    }*/

}