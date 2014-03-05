<?php
namespace CloudFlareTest\Factory;

use CloudFlare\Factory\SettingsConsoleControllerFactory;

class SettingsConsoleControllerFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var SettingsConsoleControllerFactory
     */
    protected $controllerFactory;

    public function setUp()
    {
        $this->controllerFactory = new SettingsConsoleControllerFactory();
    }

    public function testCreateService()
    {
        $serviceManager = $this->getMockBuilder('Zend\ServiceManager\ServiceManager')
            ->disableOriginalConstructor()
            ->setMethods(array('getServiceLocator', 'get'))
            ->getMock();

        $serviceManager->expects($this->once())
            ->method('getServiceLocator')
            ->will($this->returnSelf());

        $settingsService = $this->getMockBuilder('CloudFlare\Service\SettingsService')
            ->disableOriginalConstructor()
            ->getMock();

        $serviceManager->expects($this->once())
            ->method('get')
            ->will($this->returnValue($settingsService));

        $controller = $this->controllerFactory->createService($serviceManager);

        $this->assertInstanceOf('CloudFlare\Controller\SettingsConsoleController', $controller);
    }
}