Feature: It is a website
    In order to use the website
    As a user
    I get a working website

    Scenario: Homepage
        When I am on "/"
        Then I should get the response code 200
        And I should see "Willkommen" in the body element

    Scenario: 404 page
        When I am on "/does-not-exist"
        Then I should get the response code 404
        And I should see "nicht gefunden" in the body element
