<?php
namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class PostCommentTest extends TestCase
{
    private $bootstrap;
    private $controller;

    protected function setUp(): void
    {
        $this->bootstrap = new \Tests\Bootstrap();

        require_once CMTX_DIR_CONTROLLER . 'main/form.php';

        $this->controller = new \Commentics\MainFormController($this->bootstrap->registry);
    }

    public function testValidateSubmit()
    {
        $this->setPostData('cmtx_honeypot', '');
        $this->setPostData('cmtx_time', time() - 10);
        $this->setPostData('cmtx_name', 'PHPUnit');
        $this->setPostData('cmtx_email', 'test@commentics.com');
        $this->setPostData('cmtx_headline', 'An example headline');
        $this->setPostData('cmtx_comment', 'This is a test by PHPUnit');
        $this->setPostData('cmtx_privacy', 1);
        $this->setPostData('cmtx_terms', 1);

        $this->setSetting('enabled_question', 0);
        $this->setSetting('enabled_captcha', 0);

        $this->controller->submit();

        $this->expectOutputRegex('/Your comment has been added/');
    }

    private function setPostData($key, $value)
    {
        $this->controller->request->post[$key] = $value;
    }

    private function setSetting($key, $value)
    {
        $this->controller->setting->set($key, $value);
    }

    protected function tearDown(): void
    {
        $this->controller->db->query("DELETE FROM `" . CMTX_DB_PREFIX . "comments` WHERE `comment` LIKE '%PHPUnit%'");
        $this->controller->db->query("DELETE FROM `" . CMTX_DB_PREFIX . "users` WHERE `name` = 'PHPUnit'");
    }
}
