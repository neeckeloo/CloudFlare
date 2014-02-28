<?php
namespace CloudFlare\Factory;

use CloudFlare\Controller\ConsoleController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ConsoleControllerFactory implements FactoryInterface
{
    /**
     * @param  ServiceLocatorInterface $serviceLocator
     * @return ConsoleController
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $serviceLocator = $serviceLocator->getServiceLocator();

        $settingsService = $serviceLocator->get('CloudFlare\Service\SettingsService');
        $dnsService = $serviceLocator->get('CloudFlare\Service\dnsService');
        $statsService = $serviceLocator->get('CloudFlare\Service\StatsService');

        return new ConsoleController($settingsService, $dnsService, $statsService);
    }
}