<?php

require_once("TestBase.php");

use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\Exception\NoSuchElementException;

final class AddCityTest extends TestBase
{
    public function testAddCity()
    {
        # open the web site with the automated browser
        self::$driver->get('http://localhost:8000/afegir_ciutat.php');

        # city data
        $newCityName = "Manresa";
        $name = self::$driver->findElement(WebDriverBy::cssSelector("input[name=nom_ciutat]"));
        $name->sendKeys($newCityName);

        $poblacio = self::$driver->findElement(WebDriverBy::cssSelector("input[name=poblacio]"));
        $poblacio->sendKeys("71000");

        $pais = self::$driver->findElement(WebDriverBy::cssSelector("select[name='codi_pais']"));
        $pais->click();

        $countryName = "Andorra";
        $element = self::$driver->findElement(WebDriverBy::xpath("//option[contains(text(),'$countryName')]"));
        $element->click();

        # Submit form 1 (add city)
        $element = self::$driver->findElement(WebDriverBy::cssSelector('input[type="submit"]'));
        $element->click();


        # Check: utilitzem pagina de filtre per veure si la ciutat s'ha afegit
        self::$driver->get('http://localhost:8000/');

        # Select the Country
        $element = self::$driver->findElement(WebDriverBy::xpath("//option[contains(text(),'$countryName')]"));
        $element->click();

        # Submit form
        $element = self::$driver->findElement(WebDriverBy::cssSelector('input[type="submit"]'));
        $element->click();

        # Check that the city appears in the list
        $element = self::$driver->findElement(WebDriverBy::xpath("//td[contains(text(),'$newCityName')]"));
        $this->assertEquals($element->getText(),$city);

    }

}
