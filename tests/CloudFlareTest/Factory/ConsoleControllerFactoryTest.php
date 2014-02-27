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
        $client = $this->getMockBuilder('CloudFlare\Client')
            ->disableOriginalConstructor()
            ->getMock();

        $serviceManager = $this->getMockBuilder('Zend\ServiceManager\ServiceManager')
            ->disableOriginalConstructor()
            ->setMethods(array('getServiceLocator', 'get'))
            ->getMock();

        $serviceManager->expects($this->once())
            ->method('getServiceLocator')
            ->will($this->returnSelf());

        $serviceManager->expects($this->once())
            ->method('get')
            ->will($this->returnValue($client));

        $controller = $this->controllerFactory->createService($serviceManager);

        $this->assertInstanceOf('CloudFlare\Controller\ConsoleController', $controller);
    }
}