<?php
namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class CaptchaTest extends TestCase
{
    private $bootstrap;
    private $controller;

    protected function setUp(): void
    {
        $this->bootstrap = new \Tests\Bootstrap();

        require_once CMTX_DIR_CONTROLLER . 'main/form.php';

        $this->controller = new \Commentics\MainFormController($this->bootstrap->registry);
    }

    public function testCaptcha()
    {
        $this->setGetData('page_id', 1);

        $this->controller->captcha();

        $this->expectOutputRegex('/[^\x20-\x7E\t\r\n]/');
    }

    private function setGetData($key, $value)
    {
        $this->controller->request->get[$key] = $value;
    }
}
