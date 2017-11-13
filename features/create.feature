Feature: Create Test
  In order to add products to the API
  As an API consumer
  I need to be able to add new books using the API

  Scenario: Create a valid book and receive the book in response
    Given I am an API consumer
    And I create a valid book by posting to the /books resource
    Then I should receive a "201" response
    And The body should contain "1" results
    And The body should contain "978-1491905012"
    And The body should contain "Modern PHP: New Features and Good Practices"
    And The body should contain "Josh Lockhart"
    And The body should contain "PHP"
    And The body should contain "18.99"

  Scenario: Create an invalid book (invalid isbn) and receive an error
    Given I am an API consumer
    And I create the invalid book by posting to the /books resource
    Then I should receive a "400" response
    And The body should contain "Invalid ISBN"
