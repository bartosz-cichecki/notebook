Feature: Create a note
  Background:
    Given there are no notes

  Scenario: Create a note
    When I create a note with name "pizza" and content "Recipe for Napoli pizza..."
    Then there should be a stored note with the content "Recipe for Napoli pizza..." for the name "pizza"
