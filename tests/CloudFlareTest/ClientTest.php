<?php
namespace CloudFlareTest;

use CloudFlare\Client;
use CloudFlare\ModuleOptions;

class ClientTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Client
     */
    protected $client;

    public function setUp()
    {
        $options = new ModuleOptions(array());

        $this->client = $this->getMockBuilder('CloudFlare\Client')
            ->setConstructorArgs(array($options))
            ->setMethods(array('send'))
            ->getMock();
    }

    public function testPurgeCache()
    {
        $this->client
            ->expects($this->once())
            ->method('send')
            ->with(array(
                'a' => 'fpurge_ts',
                'z' => 'domain.com',
                'v' => 1,
            ));

        $this->client->purge('domain.com');
    }

    public function testSetCacheLevel()
    {
        $cacheLevel = Client::CACHE_LEVEL_BASIC;

        $this->client
            ->expects($this->once())
            ->method('send')
            ->with(array(
                'a' => 'cache_lvl',
                'z' => 'domain.com',
                'v' => $cacheLevel,
            ));

        $this->client->setCacheLevel('domain.com', $cacheLevel);
    }

    public function testSetSecurityLevel()
    {
        $securityLevel = Client::SECURITY_LEVEL_LOW;

        $this->client
            ->expects($this->once())
            ->method('send')
            ->with(array(
                'a' => 'sec_lvl',
                'z' => 'domain.com',
                'v' => $securityLevel,
            ));

        $this->client->setSecurityLevel('domain.com', $securityLevel);
    }

    public function testSetDevelopmentMode()
    {
        $mode = 1;

        $this->client
            ->expects($this->once())
            ->method('send')
            ->with(array(
                'a' => 'devmode',
                'z' => 'domain.com',
                'v' => $mode,
            ));

        $this->client->setDevelopmentMode('domain.com', $mode);
    }
}