<?php

require_once("TestBase.php");

use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\Exception\NoSuchElementException;

final class AddCityTest extends TestBase
{

    public function testAddCity()
    {
        $newCityName = "Manresa";
        $countryName = "Andorra";
        $this->addCity($newCityName,$countryName,69000);

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
        $this->assertEquals($element->getText(),$newCityName);
    }

    public function testDuplicatedCityError()
    {
        $this->addCity("La Massana","Andorra",2000);

        # Check that we got aproppriate feedback
        $element = self::$driver->findElement(WebDriverBy::cssSelector('div.missatge'));
        $this->assertEquals("Ciutat afegida correctament",$element->getText());

        $this->addCity("La Massana","Andorra",2000);

        # Check that we got aproppriate feedback
        $element = self::$driver->findElement(WebDriverBy::cssSelector('div.missatge'));
        $this->assertEquals("Aquesta ciutat ja existeix en aquest país",$element->getText());
    }

    private function addCity($newCityName,$countryName,$poblacio)
    {
        # open the web site with the automated browser
        self::$driver->get('http://localhost:8000/afegir_ciutat.php');

        # city data
        $name = self::$driver->findElement(WebDriverBy::cssSelector("input[name=nom_ciutat]"));
        $name->sendKeys($newCityName);

        $pobl = self::$driver->findElement(WebDriverBy::cssSelector("input[name=poblacio]"));
        $pobl->sendKeys($poblacio);

        $pais = self::$driver->findElement(WebDriverBy::cssSelector("select[name='codi_pais']"));
        $pais->click();

        $element = self::$driver->findElement(WebDriverBy::xpath("//option[contains(text(),'$countryName')]"));
        $element->click();

        # Submit form 1 (add city)
        $element = self::$driver->findElement(WebDriverBy::cssSelector('input[type="submit"]'));
        $element->click();
    }

}
