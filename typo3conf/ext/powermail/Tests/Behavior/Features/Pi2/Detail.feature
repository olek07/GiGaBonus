# Features/Pi2/Detail.feature
@Pi2 @Pi2Detail
Feature: Detail

  @Pi2DetailEntry
  Scenario: Add a new dummy Entry
    Given I am on "/index.php?id=40"
    When I fill in "tx_powermail_pi1[field][string]" with "Andy Kräuter"
    When I fill in "tx_powermail_pi1[field][textarea]" with "Das ist ein Test"
    When I select "Sandra" from "tx_powermail_pi1[field][marker]"
    When I select "Alex" from "tx_powermail_pi1[field][selectmulti][]"
    When I additionally select "Olli" from "tx_powermail_pi1[field][selectmulti][]"
    When I check "tx_powermail_pi1[field][marker_01][]"
    When I select "Silke" from "tx_powermail_pi1[field][radio]"
    And I press "Submit"
    And I press "Weiter"
    Then I should see "Andy Kräuter"

  @Pi2DetailCheckEntry
  Scenario: Follow detaillink in listview
    Given I am on "/index.php?id=30"
    Then I follow "Details"
    Then I wait "a few" seconds
    Then I should see "String"
    Then I should see "Andy Kräuter"
    Then I should see "Das ist ein Test"
    Then I should see "Sandra"
    Then I should see "Alex"
    Then I should see "Silke"
