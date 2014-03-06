<?php
namespace CloudFlareTest\Factory;

use CloudFlare\Factory\ModuleOptionsFactory;
use Zend\ServiceManager\ServiceManager;

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
        $serviceManager = new ServiceManager;
        $serviceManager->setService('Config', array(
            'cloudflare' => array(),
        ));

        $moduleOptions = $this->moduleOptionsFactory->createService($serviceManager);
        $this->assertInstanceOf('CloudFlare\ModuleOptions', $moduleOptions);
    }
}