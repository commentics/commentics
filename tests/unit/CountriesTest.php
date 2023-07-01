<?php
namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class CountriesTest extends TestCase
{
    private $bootstrap;
    private $controller;

    protected function setUp(): void
    {
        $this->bootstrap = new \Tests\Bootstrap();

        require_once CMTX_DIR_CONTROLLER . 'main/form.php';

        $this->controller = new \Commentics\MainFormController($this->bootstrap->registry);
    }

    public function testCountries()
    {
        $this->controller->getCountries();

        $this->expectOutputRegex('/"UK"/');
    }
}
