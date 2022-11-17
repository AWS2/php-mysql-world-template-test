<?php declare(strict_types=1);
# thanks to https://jakobbr.eu/2020/10/24/adventures-with-phpunit-geckodriver-and-selenium/

namespace Facebook\WebDriver;

use PHPUnit\Framework\TestCase;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\Exception\UnknownErrorException;

final class FilterTest extends TestCase
{
    protected static $driver;

    public static function setUpBeforeClass(): void 
    {
        $host = 'http://localhost:4444';

        $capabilities = DesiredCapabilities::firefox();
        $capabilities->setCapability('moz:firefoxOptions', ['args' => ['-headless']]);
        $capabilities->setPlatform(WebDriverPlatform::LINUX);

        self::$driver = RemoteWebDriver::create($host, $capabilities);
    }
    
    public static function tearDownAfterClass(): void
    {
        self::$driver->quit();
    }

    public function testTitol() {
        # open the web site with the automated browser
        self::$driver->get('http://localhost:8000');

        # Test que el títol és correcte
        $titol = "Filtre de ciutats per país";
        $h1 = self::$driver->findElement(WebDriverBy::xpath("//h1[contains(text(),'$titol')]"));

        $this->assertEquals($h1->getText(),$titol);

    }

    public function testSuccessfulCityFilter()
    {
        # open the web site with the automated browser
        self::$driver->get('http://localhost:8000');

        # open dropdown
        $element = self::$driver->findElement(WebDriverBy::cssSelector("select[name='codi_pais']"));
        $element->click();

        # Select a Country
        $countryName = "France";
        $element = self::$driver->findElement(WebDriverBy::xpath("//option[contains(text(),'$countryName')]"));
        $element->click();

        # Submit form
        $element = self::$driver->findElement(WebDriverBy::cssSelector('input[type="submit"]'));
        $element->click();

        # Check that the product appears in the list
        $city = "Montpellier";
        $elements = self::$driver->findElements(WebDriverBy::cssSelector('td'));
        $found = false;
        foreach ($elements as $element) {
            if( $element->getText()==$city )
                $found = true;
        }

        $this->assertEquals($found,true);

    }

}
