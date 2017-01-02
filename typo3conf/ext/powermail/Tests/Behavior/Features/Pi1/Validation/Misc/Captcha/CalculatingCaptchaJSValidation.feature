# Features/Pi1/Validation/CaptchaValidation.feature
@Pi1 @Pi1Validation @Pi1ValidationMisc @Pi1ValidationMiscCaptcha @Pi1ValidationMiscCaptchaCalculatingCaptchaJSValidation
Feature: Pi1ValidationMiscCaptchaCalculatingCaptchaJSValidation

  @javascript
  Scenario: Check if JavaScript mandatory validation works
    Given I am on "/index.php?id=220"
    Then I should see "Captcha"
    Then I should see an "#powermail_field_captcha" element
    And I press "Submit"
    Then I should see "Dieses Feld muss ausgefüllt werden!"

    When I fill in "tx_powermail_pi1[field][captcha]" with "3"
    And I press "Submit"

    Then I should see "alex@in2code.de"
    Then I should see "3"
