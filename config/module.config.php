<?php
return array(
    'service_manager' => array(
        'factories' => array(
            'CloudFlare\Client'        => 'CloudFlare\Factory\ClientFactory',
            'CloudFlare\ModuleOptions' => 'CloudFlare\Factory\ModuleOptionsFactory',
        ),
    ),

    'controllers' => array(
        'factories' => array(
            'CloudFlare\Controller\ConsoleController' => 'CloudFlare\Factory\ConsoleControllerFactory',
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
                            'controller' => 'CloudFlare\Controller\ConsoleController',
                            'action'     => 'purge',
                        ),
                    ),
                ),
                'cdn-cache-lvl' => array(
                    'type' => 'Simple',
                    'options' => array(
                        'route'    => 'cdn cache_lvl <domain> <level>',
                        'defaults' => array(
                            'controller' => 'CloudFlare\Controller\ConsoleController',
                            'action'     => 'cache-level',
                        ),
                    ),
                ),
                'cdn-sec-lvl' => array(
                    'type' => 'Simple',
                    'options' => array(
                        'route'    => 'cdn sec_lvl <domain> <level>',
                        'defaults' => array(
                            'controller' => 'CloudFlare\Controller\ConsoleController',
                            'action'     => 'security-level',
                        ),
                    ),
                ),
                'cdn-dev-mode' => array(
                    'type' => 'Simple',
                    'options' => array(
                        'route'    => 'cdn dev_mode <domain> <mode>',
                        'defaults' => array(
                            'controller' => 'CloudFlare\Controller\ConsoleController',
                            'action'     => 'development-mode',
                        ),
                    ),
                ),
            ),
        ),
    ),
);