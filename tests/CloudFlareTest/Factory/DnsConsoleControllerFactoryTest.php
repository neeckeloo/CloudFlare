<?php
namespace CloudFlareTest\Factory;

use CloudFlare\Factory\DnsConsoleControllerFactory;

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
        $serviceManager = $this->getMockBuilder('Zend\ServiceManager\ServiceManager')
            ->disableOriginalConstructor()
            ->setMethods(array('getServiceLocator', 'get'))
            ->getMock();

        $serviceManager->expects($this->once())
            ->method('getServiceLocator')
            ->will($this->returnSelf());

        $dnsService = $this->getMockBuilder('CloudFlare\Service\DnsService')
            ->disableOriginalConstructor()
            ->getMock();

        $serviceManager->expects($this->once())
            ->method('get')
            ->will($this->returnValue($dnsService));

        $controller = $this->controllerFactory->createService($serviceManager);

        $this->assertInstanceOf('CloudFlare\Controller\DnsConsoleController', $controller);
    }
}