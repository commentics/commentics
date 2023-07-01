<?php
namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class ValidateNameTest extends TestCase
{
    private $bootstrap;
    private $controller;

    protected function setUp(): void
    {
        $this->bootstrap = new \Tests\Bootstrap();

        require_once CMTX_DIR_CONTROLLER . 'main/form.php';

        $this->controller = new \Commentics\MainFormController($this->bootstrap->registry);

        $this->controller->loadModel('main/form_validate');
    }

    public function testValidateNameBlank()
    {
        $this->setPostData('cmtx_name', '');
        $this->callMethod('validateName', array(false));
        $this->assertEquals('Please enter your name', $this->getFieldError('name'));
    }

    public function testValidateNameOkay()
    {
        $this->setPostData('cmtx_name', "Stèven3 .&-'");
        $this->callMethod('validateName', array(false));
        $this->assertNull($this->getFieldError('name'));
    }

    public function testValidateNameInvalidChars()
    {
        $this->setPostData('cmtx_name', 'St^ven');
        $this->callMethod('validateName', array(false));
        $this->assertStringStartsWith('The name can only contain', $this->getFieldError('name'));
    }

    public function testValidateNameNoFirstLetter()
    {
        $this->setPostData('cmtx_name', '3Steven');
        $this->callMethod('validateName', array(false));
        $this->assertEquals('The name must start with a letter', $this->getFieldError('name'));
    }

    public function testValidateNameMaxLength()
    {
        $this->setPostData('cmtx_name', 'Steven3333333333333333333333333');
        $this->callMethod('validateName', array(false));
        $this->assertStringStartsWith('Must be between 1 and', $this->getFieldError('name'));
    }

    public function testValidateNameDummy()
    {
        $this->setPostData('cmtx_name', 'test');
        $this->callMethod('validateName', array(false));
        $this->assertEquals('Please enter your real name', $this->getFieldError('name'));
    }

    public function testValidateNameReserved()
    {
        $this->setPostData('cmtx_name', 'admin');
        $this->callMethod('validateName', array(false));
        $this->assertEquals('The name entered is reserved', $this->getFieldError('name'));
    }

    private function setPostData($key, $value)
    {
        $this->controller->request->post[$key] = $value;
    }

    private function callMethod($method, $args)
    {
        $this->controller->model_main_form_validate->{$method}(implode(', ', $args));
    }

    private function getFieldError($field)
    {
        $json = $this->controller->model_main_form_validate->getJson();

        if (isset($json['error'][$field])) {
            return $json['error'][$field];
        } else {
            return null;
        }
    }
}
