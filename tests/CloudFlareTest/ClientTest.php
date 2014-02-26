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
}