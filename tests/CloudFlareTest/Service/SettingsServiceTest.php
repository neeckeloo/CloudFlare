<?php
namespace CloudFlareTest\Service;

use CloudFlare\Service\SettingsService;
use CloudFlare\ModuleOptions;

class SettingsServiceTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var SettingsService
     */
    protected $service;

    public function setUp()
    {
        $this->service = $this->getMockBuilder('CloudFlare\Service\SettingsService')
            ->setMethods(array('send'))
            ->getMock();

        $options = new ModuleOptions(array());
        $this->service->setModuleOptions($options);
    }

    public function testPurgeCache()
    {
        $this->service
            ->expects($this->once())
            ->method('send')
            ->with(array(
                'a' => 'fpurge_ts',
                'z' => 'domain.com',
                'v' => 1,
            ));

        $this->service->purge('domain.com');
    }

    public function testSetCacheLevel()
    {
        $cacheLevel = SettingsService::CACHE_LEVEL_BASIC;

        $this->service
            ->expects($this->once())
            ->method('send')
            ->with(array(
                'a' => 'cache_lvl',
                'z' => 'domain.com',
                'v' => $cacheLevel,
            ));

        $this->service->setCacheLevel('domain.com', $cacheLevel);
    }

    public function testSetSecurityLevel()
    {
        $securityLevel = SettingsService::SECURITY_LEVEL_LOW;

        $this->service
            ->expects($this->once())
            ->method('send')
            ->with(array(
                'a' => 'sec_lvl',
                'z' => 'domain.com',
                'v' => $securityLevel,
            ));

        $this->service->setSecurityLevel('domain.com', $securityLevel);
    }

    public function testSetDevelopmentMode()
    {
        $mode = 1;

        $this->service
            ->expects($this->once())
            ->method('send')
            ->with(array(
                'a' => 'devmode',
                'z' => 'domain.com',
                'v' => $mode,
            ));

        $this->service->setDevelopmentMode('domain.com', $mode);
    }
}