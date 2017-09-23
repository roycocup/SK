Feature: Setup
  In order to import data into the database
  As a user with access to the command line
  I need run a command against src/cli/setup.php

  Scenario: Getting the data into a database
    Given I have a "setup.php" file at "."
    When I run "php setup.php"
    Then I should get:
      """
      All done.
      """
