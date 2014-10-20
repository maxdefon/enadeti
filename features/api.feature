Feature: API
  Scenario: Using steps API
    Given I call "/api/steps"
    Then the status code is 200
    And the response is []
