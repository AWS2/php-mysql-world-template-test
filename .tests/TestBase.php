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
        # start firefox
        $capabilities = DesiredCapabilities::firefox();
        $capabilities->setCapability('moz:firefoxOptions', ['args' => ['-headless']]);
        self::$driver = FirefoxDriver::start($capabilities);
    }
    
    public static function tearDownAfterClass(): void
    {
        # exit firefox
        self::$driver->quit();
    }

}
