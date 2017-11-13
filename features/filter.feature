Feature: Fetch Test
  In order to fetch products from the API
  As an API consumer
  I need to be able to query the API using different criteria

  Scenario: Filter by author and expect two books in response
    Given I am an API consumer
    And I filter by "author" "Robin Nixon"
    And I fetch the results from the /books resource
    Then I should receive a "200" response
    And The body should contain "2" results
    And The body should contain "978-1491918661"
    And The body should contain "978-0596804848"

  Scenario: Filter by author and expect one book in response
    Given I am an API consumer
    And I filter by "author" "Christopher Negus"
    And I fetch the results from the /books resource
    Then I should receive a "200" response
    And The body should contain "1" results
    And The body should contain "978-1118999875"

  Scenario: Request all categories and expect three categories in response
    Given I am an API consumer
    And I fetch the results from the /books/categories resource
    Then I should receive a "200" response
    And The body should contain "3" results
    And The body should contain "PHP"
    And The body should contain "Javascript"
    And The body should contain "Linux"

  Scenario: Filter by category and expect two books in response
    Given I am an API consumer
    And I filter by "category" "Linux"
    And I fetch the results from the /books resource
    Then I should receive a "200" response
    And The body should contain "2" results
    And The body should contain "978-0596804848"
    And The body should contain "978-1118999875"

  Scenario: Filter by category and expect one book in response
    Given I am an API consumer
    And I filter by "category" "PHP"
    And I fetch the results from the /books resource
    Then I should receive a "200" response
    And The body should contain "1" results
    And The body should contain "978-1491918661"

  Scenario: Filter by author and category and expect one book in response
    Given I am an API consumer
    And I filter by "author" "Robin Nixon"
    And I filter by "category" "Linux"
    And I fetch the results from the /books resource
    Then I should receive a "200" response
    And The body should contain "1" results
    And The body should contain "978-0596804848"
