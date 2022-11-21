<?php

require_once("TestBase.php");

use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\Exception\NoSuchElementException;

final class JoinTest extends TestBase
{
    public function testJoinShowsCountryName()
    {
        # open the web site with the automated browser
        self::$driver->get('http://localhost:8000');

        # open dropdown
        $element = self::$driver->findElement(WebDriverBy::cssSelector("select[name='codi_pais']"));
        $element->click();

        # Select a Country
        $countryName = "Australia";
        $element = self::$driver->findElement(WebDriverBy::xpath("//option[contains(text(),'$countryName')]"));
        $element->click();

        # Submit form
        $element = self::$driver->findElement(WebDriverBy::cssSelector('input[type="submit"]'));
        $element->click();

        # The number of rows-1 is the number of cities
        $elements = self::$driver->findElements(WebDriverBy::xpath("//tr"));
        $nCities = count($elements)-1;

        # Check that the country name appears in the list as many times as the cities
        $elements = self::$driver->findElements(WebDriverBy::xpath("//td[text() = '$countryName']"));
        # Australia has 14 cities
        $this->assertEquals($nCities,count($elements),"Ha de sortir el nom del país a cada registre de cada ciutat.");
    }

}
