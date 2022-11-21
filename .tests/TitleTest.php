<?php

require_once("TestBase.php");

use Facebook\WebDriver\WebDriverBy;

final class TitleTest extends TestBase
{
    # TestBase inclou els mètodes d'inicialització i tancament
    
    public function testTitol()
    {
        # obrir website
        self::$driver->get('http://localhost:8000');

        # Test que el títol és correcte
        $titol = "Filtre de ciutats per país";
        $h1 = self::$driver->findElement(WebDriverBy::xpath("//h1[contains(text(),'$titol')]"));

        $this->assertEquals($h1->getText(),$titol);
    }
}
