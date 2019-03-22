<?php
namespace Tests\Locastic\SyliusStoreLocatorPlugin\Behat\Context\Ui\Admin;

use Behat\Behat\Context\Context;
use Behat\Mink\Driver\Selenium2Driver;
use Behat\Mink\Exception\UnsupportedDriverActionException;
use Behat\MinkExtension\Context\MinkContext;
use Locastic\SyliusStoreLocatorPlugin\Entity\StoreInterface;
use Sylius\Behat\Page\Admin\Crud\IndexPageInterface;
use Tests\Locastic\SyliusStoreLocatorPlugin\Behat\Page\Admin\Store\CreatePageInterface;
use Tests\Locastic\SyliusStoreLocatorPlugin\Behat\Page\Admin\Store\UpdatePageInterface;
use Webmozart\Assert\Assert;

final class ManagingStoresContext extends MinkContext implements Context
{
    /**
     * @var IndexPageInterface
     */
    private $indexPage;

    /**
     * @var CreatePageInterface
     */
    private $createPage;

    /**
     * @var UpdatePageInterface
     */
    private $updatePage;

    /**
     * @param IndexPageInterface $indexPage
     * @param CreatePageInterface $createPage
     * @param UpdatePageInterface $updatePage
     */
    public function __construct(
        IndexPageInterface $indexPage,
        CreatePageInterface $createPage,
        UpdatePageInterface $updatePage
    ) {
        $this->indexPage = $indexPage;
        $this->createPage = $createPage;
        $this->updatePage = $updatePage;
    }

    /**
     * @When /^I want to browse stores$/
     */
    public function iWantToBrowseStores()
    {
        $this->indexPage->open();
    }

    /**
     * @Then /^I should see (\d+) stores in the list$/
     */
    public function iShouldSeeStoresInTheList(int $numberOfStores)
    {
        Assert::same($this->indexPage->countItems(), $numberOfStores);
    }

    /**
     * @Given /^the store "([^"]*)" should be in the registry$/
     */
    public function theStoreShouldBeInTheRegistry($storeName)
    {
        $this->iWantToBrowseStores();

        Assert::true($this->indexPage->isSingleResourceOnPage(['name' => $storeName]));
    }

    /**
     * @When /^I delete (store "[^"]+")$/
     */
    public function iDeleteStore(StoreInterface $store)
    {
        $this->indexPage->open();
        $this->indexPage->deleteResourceOnPage(['code' => $store->getCode()]);
    }

    /**
     * @When /^I want to create a new store$/
     */
    public function iWantToCreateANewStore()
    {
        $driver = $this->getSession()->getDriver();

        if (!$driver instanceof Selenium2Driver) {
            throw new UnsupportedDriverActionException('Selenium2Driver not installed.');

            return;
        }

        $this->createPage->open();
    }

    /**
     * @When I specify its code as :storeCode
     */
    public function iSpecifyItsCodeAs($storeCode)
    {
        $this->createPage->specifyCode($storeCode);
    }
}