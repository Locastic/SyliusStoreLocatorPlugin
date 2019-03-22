@store
Feature: Seeing store locator index page
  As a Customer
  I want to be able to see index page with all store locations listed

  Background:
    Given the store operates on a single channel in "United States"
    Given the store has "Dragon Store" store location
    Given the store has "Bunny Store" store location

  @ui
  Scenario: Seeing the store locator page
    Given I am at the store locator index page
    Then I should see the store map
    And I should see the "Dragon Store" store location
    And I should see the "Bunny Store" store location