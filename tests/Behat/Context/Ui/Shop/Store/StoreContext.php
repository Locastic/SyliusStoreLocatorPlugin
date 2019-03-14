<?php

namespace Tests\Locastic\SyliusStoreLocatorPlugin\Behat\Context\Ui\Shop\Store;

use Behat\Behat\Context\Context;
use Sylius\Component\Core\Formatter\StringInflector;
use Tests\Locastic\SyliusStoreLocatorPlugin\Behat\Page\Shop\Store\StoreIndexPage;
use Tests\Locastic\SyliusStoreLocatorPlugin\Behat\Page\Shop\Store\StoreShowPage;
use Webmozart\Assert\Assert;

final class StoreContext implements Context
{
    /**
     * @var StoreIndexPage
     */
    private $storeIndexPage;

    /**
     * @var StoreShowPage
     */
    private $storeShowPage;

    /**
     * StoreContext constructor.
     * @param StoreIndexPage $storeIndexPage
     * @param StoreShowPage $storeShowPage
     */
    public function __construct(StoreIndexPage $storeIndexPage, StoreShowPage $storeShowPage)
    {
        $this->storeIndexPage = $storeIndexPage;
        $this->storeShowPage = $storeShowPage;
    }


    /**
     * @Given I am at the store locator index page
     * @When I go back to store locator index page
     */
    public function iAmAtTheStoreLocatorIndexPage()
    {
        $this->storeIndexPage->open();
    }

    /**
     * @Then /^I should see the store map$/
     */
    public function iShouldSeeTheStoreMap()
    {
        Assert::notNull($this->storeIndexPage->hasStoreMap());
    }

    /**
     * @Given /^I should see the "([^"]*)" store location$/
     */
    public function iShouldSeeTheStoreLocation($storeName)
    {
        Assert::true($this->storeIndexPage->hasStorePreview($storeName));
    }

    /**
     * @Given /^I go to "([^"]*)" store location page$/
     */
    public function iGoToStoreLocationPage($storeName)
    {
        $this->storeShowPage->open(['slug' => StringInflector::nameToCode(strtolower($storeName))]);
    }

    /**
     * @Given /^I should see "([^"]*)" store information$/
     */
    public function iShouldSeeStoreInformation($storeName)
    {
        Assert::true($this->storeShowPage->hasStoreInformation($storeName));
    }

    /**
     * @Given /^I should see store images$/
     */
    public function iShouldSeeStoreImages()
    {
        Assert::true($this->storeShowPage->hasStoreImage());
    }
}