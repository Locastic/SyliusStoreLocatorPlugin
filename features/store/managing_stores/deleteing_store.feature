@managing_stores
Feature: Deleting a store
  In order to remove test, obsolete or incorrect stores
  As an Administrator
  I want to be able to delete a store

  Background:
    Given the store has "Dragon Store" store location
    Given the store has "Bunny Store" store location
    And I am logged in as an administrator

  @ui
  Scenario: Deleted store should disappear from the registry
    When I delete store "Dragon Store"
    Then I should see 1 stores in the list
    And the store "Bunny Store" should be in the registry
