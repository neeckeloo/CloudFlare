<?php
namespace CloudFlareTest\Factory;

use CloudFlare\Factory\ConsoleControllerFactory;

class ConsoleControllerFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ConsoleControllerFactory
     */
    protected $controllerFactory;

    public function setUp()
    {
        $this->controllerFactory = new ConsoleControllerFactory();
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

        $serviceManager->expects($this->at(1))
            ->method('get')
            ->will($this->returnValue($settingsService));

        $dnsService = $this->getMockBuilder('CloudFlare\Service\DnsService')
            ->disableOriginalConstructor()
            ->getMock();

        $serviceManager->expects($this->at(2))
            ->method('get')
            ->will($this->returnValue($dnsService));

        $statsService = $this->getMockBuilder('CloudFlare\Service\StatsService')
            ->disableOriginalConstructor()
            ->getMock();

        $serviceManager->expects($this->at(3))
            ->method('get')
            ->will($this->returnValue($statsService));

        $controller = $this->controllerFactory->createService($serviceManager);

        $this->assertInstanceOf('CloudFlare\Controller\ConsoleController', $controller);
    }
}