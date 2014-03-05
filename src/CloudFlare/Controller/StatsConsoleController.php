<?php
namespace CloudFlare\Controller;

use CloudFlare\Service\StatsService;
use Zend\Mvc\Controller\AbstractActionController;

class StatsConsoleController extends AbstractActionController
{
    /**
     * @var StatsService
     */
    protected $statsService;

    /**
     * @param StatsService $statsService
     */
    public function __construct(StatsService $statsService)
    {
        $this->statsService = $statsService;
    }
}