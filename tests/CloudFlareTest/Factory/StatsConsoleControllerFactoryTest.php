<?php
namespace CloudFlareTest\Factory;

use CloudFlare\Factory\StatsConsoleControllerFactory;
use Zend\ServiceManager\ServiceManager;

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
        $serviceManager = new ServiceManager;
        $serviceManager->setService('CloudFlare\Service\StatsService', new \CloudFlare\Service\StatsService());

        $pluginManager = $this->getMockBuilder('Zend\ServiceManager\AbstractPluginManager')
            ->disableOriginalConstructor()
            ->setMethods(array('getServiceLocator', 'validatePlugin'))
            ->getMock();

        $pluginManager->expects($this->once())
            ->method('getServiceLocator')
            ->will($this->returnValue($serviceManager));

        $controller = $this->controllerFactory->createService($pluginManager);
        $this->assertInstanceOf('CloudFlare\Controller\StatsConsoleController', $controller);
    }
}