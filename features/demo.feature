# This file contains a user story for demonstration only.
# Learn how to get started with Behat and BDD on Behat's website:
# http://behat.org/en/latest/quick_start.html

Feature:
    In order to prove that the Behat Symfony extension is correctly installed
    As a user
    I want to have a demo scenario

    Scenario: It receives a response from Symfony's kernel
        When a demo scenario sends a request to "/"
        Then the response should be received

    Scenario: I can navigate to the homepage
        When I am on the homepage
#        Then the response status code should be 200

    @javascript
    Scenario: I can open the homepage in the Browser
        When I am on "/sys/healt/check"
        Then I should see "active"