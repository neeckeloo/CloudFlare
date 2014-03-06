<?php
namespace CloudFlareTest\Factory;

use CloudFlare\Factory\DnsConsoleControllerFactory;
use Zend\ServiceManager\ServiceManager;

class DnsConsoleControllerFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var DnsConsoleControllerFactory
     */
    protected $controllerFactory;

    public function setUp()
    {
        $this->controllerFactory = new DnsConsoleControllerFactory();
    }

    public function testCreateService()
    {
        $serviceManager = new ServiceManager;
        $serviceManager->setService('CloudFlare\Service\DnsService', new \CloudFlare\Service\DnsService());

        $pluginManager = $this->getMockBuilder('Zend\ServiceManager\AbstractPluginManager')
            ->disableOriginalConstructor()
            ->setMethods(array('getServiceLocator', 'validatePlugin'))
            ->getMock();

        $pluginManager->expects($this->once())
            ->method('getServiceLocator')
            ->will($this->returnValue($serviceManager));

        $controller = $this->controllerFactory->createService($pluginManager);
        $this->assertInstanceOf('CloudFlare\Controller\DnsConsoleController', $controller);
    }
}