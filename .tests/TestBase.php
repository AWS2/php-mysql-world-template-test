<?php declare(strict_types=1);
# thanks to https://jakobbr.eu/2020/10/24/adventures-with-phpunit-geckodriver-and-selenium/
# doc https://github.com/php-webdriver/php-webdriver/wiki/Firefox

use PHPUnit\Framework\TestCase;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Firefox\FirefoxDriver;
use Facebook\WebDriver\Firefox\FirefoxOptions;
use Facebook\WebDriver\Exception\UnknownErrorException;

class TestBase extends TestCase
{
    protected static $driver;

    public static function setUpBeforeClass(): void 
    {
        # Start PHP server
        exec(".scripts/start.sh");

        # Gecko driver
        # setup vars
        $capabilities = DesiredCapabilities::firefox();
        # get env vars
        $headless = getenv('HEADLESS');
        if( $headless!=="off" ) {
            $capabilities->setCapability('moz:firefoxOptions', ['args' => ['-headless']]);
        }
        # start firefox
        self::$driver = FirefoxDriver::start($capabilities);
    }
    
    public static function tearDownAfterClass(): void
    {
        # exit firefox
        self::$driver->quit();
        # Stop PHP server
        exec(".scripts/stop.sh");
    }

}
