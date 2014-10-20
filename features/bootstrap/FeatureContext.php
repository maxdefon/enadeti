<?php

include __DIR__.'/../../vendor/autoload.php';

use Behat\Behat\Context\ClosuredContextInterface,
    Behat\Behat\Context\TranslatedContextInterface,
    Behat\Behat\Context\BehatContext,
    Behat\Behat\Exception\PendingException;

use Behat\Gherkin\Node\PyStringNode,
    Behat\Gherkin\Node\TableNode;

use Behat\MinkExtension\Context\MinkContext;

class FeatureContext extends MinkContext {

  public function __construct(array $params) {
    $this->client = new \Guzzle\Service\Client($params['base_url']);
  }

  /** @BeforeFeature */
  public static function prepareForTheFeature(){
  }
  
  /**
   *  @When /^I click on "([^"]*)"$/
   */
  public function iClickOn($selector) {
    $this->getMainContext()->getSession()->getPage()->find('css',$selector)->click();
  }
  
  
  /**
   * @Then /^I wait (\d+)$/
   */
  public function iWait($t) {
    $this->getMainContext()->getSession()->wait((int)$t);
  }
  
  /**
   * @Then /^I fill field "([^"]+)" with "([^"]+)"$/
   */
  public function iFillField($sel,$text) {
    $this->getMainContext()->getSession()->executeScript('$("'.$sel.'").val("'.$text.'")');
  }

  /** 
   * @Given /^I call "([^"]*)"$/
   */
  public function iCall($api) {
    $this->response = $this->client->get($api)->send();
  }

  /**
   * @Then /^the status code is (\d+)$/
   */
  public function theStatusIs($status) {
    if($status != $this->response->getStatusCode()) {
      throw new \Exception("Wrong status code ".$this->response->getStatusCode());
    }
  }

  /**
   * @Then /^the response is (.*)$/
   */
  public function responseIs($r) {
    if($r != $this->response->getBody()) {
      throw new \Exception("Response did not match: \n Expected: ".$r."\n Got: ".$this->response->getBody());
    }
  }
}

