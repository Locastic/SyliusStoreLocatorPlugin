@managing_stores
Feature: Browsing stores
    In order to have a overview of all defined stores
    As an Administrator
    I want to be able to browse list of them

    Background:
        Given I am logged in as an administrator
        Given the store has "Dragon Store" store location
        Given the store has "Bunny Store" store location

    @ui
    Scenario: Browsing defined stores
        When I want to browse stores
        Then I should see 2 stores in the list
        And the store "Bunny Store" should be in the registry
