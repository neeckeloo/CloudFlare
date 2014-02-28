<?php
namespace CloudFlare;

use Zend\Console\Adapter\AdapterInterface as ConsoleAdapterInterface;
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

    public function getConsoleBanner(ConsoleAdapterInterface $console)
    {
        return 'CloudFlare';
    }

    public function getConsoleUsage(ConsoleAdapterInterface $console)
    {
        return array(
            'cdn purge <domain>' => 'Clear cache',
            'cdn cache_lvl <cache_level>' => 'Set the cache level',
            'cdn sec_lvl <security_level>' => 'Set the security level',
            'cdn dev_mode <dev_mode>' => 'Toggling Development Mode',

            array('<domain>', 'Target domain'),
            array('<cache_level>', 'Security level'),
            array('<security_level>', 'Security level'),
            array('<dev_mode>', 'Development mode'),
        );
    }
}
