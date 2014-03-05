<?php
namespace CloudFlare\Controller;

use CloudFlare\Service\DnsService;
use Zend\Mvc\Controller\AbstractActionController;

class DnsConsoleController extends AbstractActionController
{
    /**
     * @var DnsService
     */
    protected $dnsService;

    /**
     * @param DnsService $dnsService
     */
    public function __construct(DnsService $dnsService)
    {
        $this->dnsService = $dnsService;
    }
}