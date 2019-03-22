@managing_stores
Feature: Adding a new store
  As an Administrator
  I want to add a new store to the registry

  Background:
    And the store is available in "English (United States)"
    And I am logged in as an administrator
    When I want to create a new store

  @ui  @javascript
  Scenario: Adding a new store
    And I specify its code as "bunny_store"
    And I name it "Bunny Store" in "English (United States)"
    And I define it for the "United States" zone
