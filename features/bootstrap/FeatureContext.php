<?php

use Behat\Behat\Context\ClosuredContextInterface,
    Behat\Behat\Context\TranslatedContextInterface,
    Behat\Behat\Context\BehatContext,
    Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode,
    Behat\Gherkin\Node\TableNode;
use Behat\MinkExtension\Context\MinkContext;

require_once __DIR__ . '/PHPBrowserMobProxy/Client.php';
require_once __DIR__ . '/php-webdriver/PHPWebDriver/WebDriver.php';
require_once __DIR__ . '/php-webdriver/PHPWebDriver/WebDriverProxy.php';
require_once 'PHPUnit/Framework/Assert/Functions.php';
require_once 'PHPUnit/Autoload.php';

/**
 * Features context.
 */
class FeatureContext extends BehatContext {

    protected static $driver;
    protected static $BrowserMob;
    protected static $BrowserMobSession;
    public $data;

    /**
     * Initializes context.
     * Every scenario gets it's own context object.
     *
     * @param array $parameters context parameters (set them up through behat.yml)
     */
    public function __construct(array $parameters) {
        
    }

    /**
     * @BeforeScenario
     */
    public function cleanup() {
        $HARFile = "/tmp/BROWSERMOBHAR.php";
        if (file_exists($HARFile)) {
            echo "The file $HARFile exists, I am going to delete it \n";
            unlink($HARFile);
        }
    }

    /**
     * @Given /^I setup BrowserMobProxy$/
     */
    public function iSetupBrowsermobproxy() {
        self::$driver = new PHPWebDriver_WebDriver();
        self::$BrowserMob = new PHPBrowserMobProxy_Client("localhost:9090");
        $additional_capabilities = array();
        $webDriverProxy = new PHPWebDriver_WebDriverProxy();
        self::$BrowserMob->new_har("google");
        $webDriverProxy->httpProxy = self::$BrowserMob->url;
        $webDriverProxy->add_to_capabilities($additional_capabilities);
        $this->session = self::$driver->session('firefox', $additional_capabilities);
    }

    /**
     * @Given /^I Navigate to "([^"]*)"$/
     */
    public function iNavigateTo($url) {

        $this->session->open($url);
    }

    /**
     * @When /^I export HAR$/
     */
    public function iExportHar() {
        file_put_contents("/tmp/BROWSERMOBHAR.php", var_export(self::$BrowserMob->har, true));
    }

    /**
     * @Then /^I should see network traffic in the HAR file$/
     */
    public function iShouldSeeNetworkTrafficInTheHarFile() {
        assertFileExists('/tmp/BROWSERMOBHAR.php');
    }

}
