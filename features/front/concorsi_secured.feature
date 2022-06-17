# This file contains a user story for demonstration only.
# Learn how to get started with Behat and BDD on Behat's website:
# http://behat.org/en/latest/quick_start.html

Feature:
    To get job information from the job board
    As a visitor
    I want to retrieve the job list

    Scenario: As an administrator user, I should be able to see the concorsi page
        Given there is an admin user with email "admin@example.com" and password "mypassword"
        And I am on "/login"
        When I fill in "Email" with "admin@example.com"
        And I fill in "Password" with "mypassword"
        And I press "login"
        And I wait 3 second
        Then I should be on "/backoffice"
        And I am on "/concorsi"
        Then I should see "Concorsi" appear
        Then I should see "Ultimi Concorsi" appear

