<?php
namespace CloudFlare;

use Zend\Console\Adapter\AdapterInterface as ConsoleAdapterInterface;
use Zend\Mvc\MvcEvent;
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;

class Module implements
    AutoloaderProviderInterface,
    ConfigProviderInterface
{
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getServiceConfig()
    {
        return array(
            'initializers' => array(
                function ($instance, $sm) {
                    if ($instance instanceof ModuleOptionsAwareInterface) {
                        $moduleOptions = $sm->get('CloudFlare\ModuleOptions');
                        $instance->setModuleOptions($moduleOptions);
                    }
                },
            ),
        );
    }

    public function onBootstrap(MvcEvent $e)
    {
        $application = $e->getApplication();
        $serviceManager = $application->getServiceManager();

        $eventManager = $application->getEventManager();
        $eventManager->attach($serviceManager->get('CloudFlare\Listener\ErrorListener'));
    }

    public function getConsoleBanner(ConsoleAdapterInterface $console)
    {
        return 'CloudFlare';
    }

    public function getConsoleUsage(ConsoleAdapterInterface $console)
    {
        return array(
            'cdn purge <domain>' => 'Clear cache',
            'cdn cache_lvl <domain> <cache_level>' => 'Set the cache level',
            'cdn sec_lvl <domain> <security_level>' => 'Set the security level',
            'cdn dev_mode <domain> <dev_mode>' => 'Toggling Development Mode',
            'cdn minify <domain> <minification>' => 'Set minification rule',

            array('<domain>', 'Target domain'),
            array('<cache_level>', 'Security level'),
            array('<security_level>', 'Security level'),
            array('<dev_mode>', 'Development mode'),
            array('<minification>', 'Minification rule'),
        );
    }
}
