<?php
namespace CloudFlareTest\Factory;

use CloudFlare\Factory\SettingsConsoleControllerFactory;
use Zend\ServiceManager\ServiceManager;

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
        $serviceManager = new ServiceManager;
        $serviceManager->setService('CloudFlare\Service\SettingsService', new \CloudFlare\Service\SettingsService());

        $pluginManager = $this->getMockBuilder('Zend\ServiceManager\AbstractPluginManager')
            ->disableOriginalConstructor()
            ->setMethods(array('getServiceLocator', 'validatePlugin'))
            ->getMock();

        $pluginManager->expects($this->once())
            ->method('getServiceLocator')
            ->will($this->returnValue($serviceManager));

        $controller = $this->controllerFactory->createService($pluginManager);
        $this->assertInstanceOf('CloudFlare\Controller\SettingsConsoleController', $controller);
    }
}