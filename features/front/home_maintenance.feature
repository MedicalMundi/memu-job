# This file contains a user story for demonstration only.
# Learn how to get started with Behat and BDD on Behat's website:
# http://behat.org/en/latest/quick_start.html

Feature:
    The front area should be under maintenance

    Scenario: I retrieve a maintenance message
        Given I am on the homepage
        Then I should see "Sorry!! We are under maintenance time."

