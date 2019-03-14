@store
Feature: Selecting shipping method with pickup at store
  In order to pick up order at store
  As a Customer
  I want to be able to choose a shipping method with pickup at store option

  Background:
    Given the store operates on a single channel in "United States"
    Given the store has a product "Targaryen T-Shirt" priced at "$19.99"
    Given the store has "Dragon Store" store location
    Given the store has "other shipping method" shipping method with "$10.00" fee
    Given the store has "pickup at store" shipping method with enabled store pickup and "$10.00" fee

  @ui
  Scenario: Selecting store pickup shipping method
    Given I have product "Targaryen T-Shirt" in the cart
    And I am at the checkout addressing step
    When I specify the email as "jon.snow@example.com"
    And I specify the shipping address as "Ankh Morpork", "Frost Alley", "90210", "United States" for "Jon Snow"
    And I complete the addressing step
    Then I should be redirected to the shipping step
    And I select "pickup at store" shipping method
    Then I should see "Dragon Store" store location
    When I select "Dragon Store" store location
    And I complete the shipping step

  @ui
  Scenario: Selecting store pickup shipping method without store selection
    Given I have product "Targaryen T-Shirt" in the cart
    And I am at the checkout addressing step
    When I specify the email as "jon.snow@example.com"
    And I specify the shipping address as "Ankh Morpork", "Frost Alley", "90210", "United States" for "Jon Snow"
    And I complete the addressing step
    Then I should be redirected to the shipping step
    And I select "pickup at store" shipping method
    And I complete the shipping step
    Then I should see a validation error

  @ui
  Scenario: I should be able to select other shipping method and not choose store
    Given I have product "Targaryen T-Shirt" in the cart
    And I am at the checkout addressing step
    When I specify the email as "jon.snow@example.com"
    And I specify the shipping address as "Ankh Morpork", "Frost Alley", "90210", "United States" for "Jon Snow"
    And I complete the addressing step
    Then I should be redirected to the shipping step
    When I select "other shipping method" shipping method
    And I complete the shipping step