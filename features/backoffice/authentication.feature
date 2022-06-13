# Learn how to get started with Behat and BDD on Behat's website:
# http://behat.org/en/latest/quick_start.html

Feature:
  In order to access to protected area
  As an administrator user
  I want to login and logout in to the system

  Scenario: Browser fixer
    Given I am on "/login"

  Scenario: As an administrator user, I should be able to authenticate
    Given there is an admin user with email "admin@example.com" and password "mypassword"
    And I am on "/login"
    When I fill in "_username" with "admin@example.com"
    And I fill in "_password" with "mypassword"
    And I press "login"
    And I wait 3 second
    Then I should be on "/backoffice"

  Scenario: As a visitor, I should not be able to navigate protected area
    Given I am on "/backoffice"
    Then I should be on "/login"

  @wip
  Scenario: As an administrator user, I should be able to see the dashboard
    Given I am authenticated as "pippo@example.com"
    When I am on "/backoffice"
    #Then I wait for "Backoffice" to appear
    Then print last response
    Then I should see "Backoffice"
    
