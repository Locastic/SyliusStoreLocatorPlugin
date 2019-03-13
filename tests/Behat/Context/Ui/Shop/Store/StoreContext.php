<?php
namespace Tests\Locastic\SyliusStoreLocatorPlugin\Behat\Context\Ui\Shop\Store;

use Behat\Behat\Context\Context;
use Tests\Locastic\SyliusStoreLocatorPlugin\Behat\Page\Shop\Store\StoreIndexPage;
use Webmozart\Assert\Assert;

final class StoreContext implements Context
{
    /**
     * @var StoreIndexPage
     */
    private $storeIndexPage;

    /**
     * StoreContext constructor.
     * @param StoreIndexPage $storeIndexPage
     */
    public function __construct(StoreIndexPage $storeIndexPage)
    {
        $this->storeIndexPage = $storeIndexPage;
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
}