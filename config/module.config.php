<?php
return array(
    'service_manager' => array(
        'invokables' => array(
            'CloudFlare\Listener\ErrorListener'  => 'CloudFlare\Listener\ErrorListener',
            'CloudFlare\Service\SettingsService' => 'CloudFlare\Service\SettingsService',
            'CloudFlare\Service\StatsService'    => 'CloudFlare\Service\StatsService',
            'CloudFlare\Service\DnsService'      => 'CloudFlare\Service\DnsService',
        ),
        'factories' => array(
            'CloudFlare\ModuleOptions' => 'CloudFlare\Factory\ModuleOptionsFactory',
        ),
    ),

    'controllers' => array(
        'factories' => array(
            'CloudFlare\Controller\DnsConsoleController'      => 'CloudFlare\Factory\DnsConsoleControllerFactory',
            'CloudFlare\Controller\SettingsConsoleController' => 'CloudFlare\Factory\SettingsConsoleControllerFactory',
            'CloudFlare\Controller\StatsConsoleController'    => 'CloudFlare\Factory\StatsConsoleControllerFactory',
        ),
    ),

    'console' => array(
        'router' => array(
            'routes' => array(
                'cdn-purge' => array(
                    'type' => 'Simple',
                    'options' => array(
                        'route'    => 'cdn purge <domain>',
                        'defaults' => array(
                            'controller' => 'CloudFlare\Controller\SettingsConsoleController',
                            'action'     => 'purge',
                        ),
                    ),
                ),
                'cdn-cache-lvl' => array(
                    'type' => 'Simple',
                    'options' => array(
                        'route'    => 'cdn cache_lvl <domain> <level>',
                        'defaults' => array(
                            'controller' => 'CloudFlare\Controller\SettingsConsoleController',
                            'action'     => 'cache-level',
                        ),
                    ),
                ),
                'cdn-sec-lvl' => array(
                    'type' => 'Simple',
                    'options' => array(
                        'route'    => 'cdn sec_lvl <domain> <level>',
                        'defaults' => array(
                            'controller' => 'CloudFlare\Controller\SettingsConsoleController',
                            'action'     => 'security-level',
                        ),
                    ),
                ),
                'cdn-dev-mode' => array(
                    'type' => 'Simple',
                    'options' => array(
                        'route'    => 'cdn dev_mode <domain> <mode>',
                        'defaults' => array(
                            'controller' => 'CloudFlare\Controller\SettingsConsoleController',
                            'action'     => 'development-mode',
                        ),
                    ),
                ),
            ),
        ),
    ),
);