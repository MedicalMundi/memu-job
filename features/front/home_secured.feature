# This file contains a user story for demonstration only.
# Learn how to get started with Behat and BDD on Behat's website:
# http://behat.org/en/latest/quick_start.html

Feature:
    To get job information from the job board
    As a visitor
    I want to retrieve the job list

    Scenario: As a visitor I can not navigate the homepage
        Given I am on "/home"
        Then I should be on "/login"

    Scenario: As an administrator user, I should be able to see the home page
        Given there is an admin user with email "admin@example.com" and password "mypassword"
        And I am on "/login"
        When I fill in "Email" with "admin@example.com"
        And I fill in "Password" with "mypassword"
        And I press "login"
        And I wait 3 second
        Then I should be on "/backoffice"
#
#    @javascript
#    Scenario: I can open the homepage in the Browser
#        Given I am on "/"
#        Then I should see "Welcome to MedicalMundi!"
#
#    @wip
#    Scenario: It receives a list of available jobs
#        Given I am on "/"
#        Then I should see "Last jobs"
