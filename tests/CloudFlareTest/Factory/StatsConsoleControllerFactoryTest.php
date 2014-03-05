<?php
namespace CloudFlareTest\Factory;

use CloudFlare\Factory\StatsConsoleControllerFactory;

class StatsConsoleControllerFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var StatsConsoleControllerFactory
     */
    protected $controllerFactory;

    public function setUp()
    {
        $this->controllerFactory = new StatsConsoleControllerFactory();
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

        $statsService = $this->getMockBuilder('CloudFlare\Service\StatsService')
            ->disableOriginalConstructor()
            ->getMock();

        $serviceManager->expects($this->once())
            ->method('get')
            ->will($this->returnValue($statsService));

        $controller = $this->controllerFactory->createService($serviceManager);

        $this->assertInstanceOf('CloudFlare\Controller\StatsConsoleController', $controller);
    }
}