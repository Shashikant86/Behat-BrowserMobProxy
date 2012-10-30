  Feature: BrowserMob Proxy with Behat
  In order to check website performance
  As a automated tester
  I need to see network traffic captured in the HAR format

  Scenario: Behat Bowsermob
    Given I setup BrowserMobProxy    
    And I Navigate to "http://www.facebook.com/"
    When I export HAR
    Then I should see network traffic in the HAR file

