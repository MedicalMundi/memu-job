# This file contains a user story for demonstration only.
# Learn how to get started with Behat and BDD on Behat's website:
# http://behat.org/en/latest/quick_start.html

Feature:
    To get job information from the job board
    As a visitor
    I want to retrieve the job list

    Scenario: I can navigate to the homepage
        Given I am on the homepage
        Then I should see "Welcome to MedicalMundi!"

    @javascript
    Scenario: I can open the homepage in the Browser
        Given I am on "/"
        Then I should see "Welcome to MedicalMundi!"

    @wip
    Scenario: It receives a list of available jobs
        Given I am on "/"
        Then I should see "Last jobs"
