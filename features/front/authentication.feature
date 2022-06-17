# Learn how to get started with Behat and BDD on Behat's website:
# http://behat.org/en/latest/quick_start.html

Feature:
  In order to access to protected area
  As an administrator user
  I want to login and logout in to the system

  Scenario: As an administrator user, I should be able to authenticate
    Given there is an admin user with email "admin@example.com" and password "mypassword"
    And I am on "/login"
    When I fill in "Email" with "admin@example.com"
    And I fill in "Password" with "mypassword"
    And I press "login"
    And I wait 3 second
    Then I should be on "/backoffice"

