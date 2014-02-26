<?php
namespace CloudFlareTest\Factory;

use CloudFlare\Factory\ClientFactory;
use CloudFlare\ModuleOptions;

class ClientFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ClientFactory
     */
    protected $clientFactory;

    public function setUp()
    {
        $this->clientFactory = new ClientFactory();
    }

    public function testCreateService()
    {
        $moduleOptions = new ModuleOptions();
        
        $serviceManager = $this->getMockBuilder('Zend\ServiceManager\ServiceManager')
            ->disableOriginalConstructor()
            ->getMock();

        $serviceManager->expects($this->once())
            ->method('get')
            ->will($this->returnValue($moduleOptions));

        $client = $this->clientFactory->createService($serviceManager);

        $this->assertInstanceOf('CloudFlare\Client', $client);
    }
}