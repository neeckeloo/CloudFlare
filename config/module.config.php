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
            ),
        ),
    ),
);