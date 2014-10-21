Feature: API

  Scenario: Using steps API
    Given I get "/api/steps"
    Then the status code is 200

  Scenario: Create user
    Given I post to "/api/user" "email=foo@bar.com&password=123&registration=321"
    Then the status code is 200
    Then the response field "email" is "foo@bar.com"

  Scenario: Login fail
    Given I get "/api/user?email=foo@bar.com&password=321"
    Then the response is null

  Scenario: Login 
    Given I get "/api/user?email=foo@bar.com&password=123"
    Then the response field "registration" is "321"

