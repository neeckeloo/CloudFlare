<?php
namespace CloudFlareTest\Factory;

use CloudFlare\Factory\ModuleOptionsFactory;

class ModuleOptionsFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ModuleOptionsFactory
     */
    protected $moduleOptionsFactory;

    public function setUp()
    {
        $this->moduleOptionsFactory = new ModuleOptionsFactory();
    }

    public function testCreateService()
    {
        $config = array(
            'cloudflare' => array(
                'api_url' => 'foo',
                'email' => 'foo',
                'token' => 'foo',
            ),
        );

        $serviceManager = $this->getMockBuilder('Zend\ServiceManager\ServiceManager')
            ->disableOriginalConstructor()
            ->setMethods(array('get'))
            ->getMock();

        $serviceManager->expects($this->once())
            ->method('get')
            ->will($this->returnValue($config));

        $moduleOptions = $this->moduleOptionsFactory->createService($serviceManager);

        $this->assertInstanceOf('CloudFlare\ModuleOptions', $moduleOptions);
    }
}