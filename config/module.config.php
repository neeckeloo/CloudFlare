<?php
return array(
    'service_manager' => array(
        'factories' => array(
            'CloudFlare\Client'        => 'CloudFlare\Factory\ClientFactory',
            'CloudFlare\ModuleOptions' => 'CloudFlare\Factory\ModuleOptionsFactory',
        ),
    ),
);