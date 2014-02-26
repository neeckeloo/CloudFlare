<?php
namespace CloudFlareTest;

use CloudFlare\ModuleOptions;

class ModuleOptionsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ModuleOptions
     */
    protected $moduleOptions;

    public function setUp()
    {
        $this->moduleOptions = new ModuleOptions();
    }

    public function testSetGetApiUrl()
    {
        $this->moduleOptions->setApiUrl('foo');
        $this->assertEquals('foo', $this->moduleOptions->getApiUrl());
    }

    public function testSetGetEmail()
    {
        $this->moduleOptions->setEmail('foo');
        $this->assertEquals('foo', $this->moduleOptions->getEmail());
    }

    public function testSetGetToken()
    {
        $this->moduleOptions->setToken('foo');
        $this->assertEquals('foo', $this->moduleOptions->getToken());
    }
}