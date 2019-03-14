@store
Feature: Seeing store locator show page
  As a Customer
  I want to be able to see store location page

  Background:
    Given the store operates on a single channel in "United States"
    Given the store has "Dragon Store" store location
    Given the store has "Bunny Store" store location

  @ui
  Scenario: Seeing the single store locator page
    Given I am at the store locator index page
    And I should see the "Dragon Store" store location
    And I should see the "Bunny Store" store location
    And I go to "Bunny Store" store location page
    Then I should see the store map
    And I should see "Bunny Store" store information
    And I should see store images