Feature: Edit a note
  Background:
    Given there are no notes

  Scenario: Edit a note
    Given there is a note with name "pizza" and content "Recipe for Napoli pizza..."
    When I edit a note "pizza" with new content "A completely new pizza recipe ..."
    Then there should be a stored note with the content "A completely new pizza recipe ..." for the name "pizza"
