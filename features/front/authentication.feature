# Learn how to get started with Behat and BDD on Behat's website:
# http://behat.org/en/latest/quick_start.html

Feature:
  In order to access to protected area
  As a administrator
  I want to login and logout in to the system

  Scenario: I can login
    Given there is an admin user with email "PIPPO@example.com" and password "mypassword"
    And I am on "/login"
    When I fill in "username" with "PIPPO@example.com"
    And I fill in "password" with "mypassword"
    And I press "login"
    And I wait 1 second
    Then I should be on "/backoffice"

