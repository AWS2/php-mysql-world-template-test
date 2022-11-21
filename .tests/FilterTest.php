<?php

require_once("TestBase.php");

use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\Exception\NoSuchElementException;

final class FilterTest extends TestBase
{
    public function testShowCountryCities()
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

        # Check that the city appears in the list
        $city = "Montpellier";
        $element = self::$driver->findElement(WebDriverBy::xpath("//td[contains(text(),'$city')]"));
        $this->assertEquals($element->getText(),$city);
    }

    public function testDontShowOtherCountriesCities()
    {
        # open the web site with the automated browser
        self::$driver->get('http://localhost:8000');

        # open dropdown
        $element = self::$driver->findElement(WebDriverBy::cssSelector("select[name='codi_pais']"));
        $element->click();

        # Select a Country
        $countryName = "Spain";
        $element = self::$driver->findElement(WebDriverBy::xpath("//option[contains(text(),'$countryName')]"));
        $element->click();

        # Submit form
        $element = self::$driver->findElement(WebDriverBy::cssSelector('input[type="submit"]'));
        $element->click();

        # Check that the city DOES NOT appear in the list
        $city = "Paris";
        try {
            $element = self::$driver->findElement(WebDriverBy::xpath("//td[contains(text(),'$city')]"));
            $this->fail("La ciutat $city no hauria d'apareixer al seleccionar $countryName.");
        } catch (NoSuchElementException $e) {
            $this->assertTrue(true);
        }

    }

}
