<?php
namespace CloudFlare\Controller;

use CloudFlare\Client;
use Zend\Mvc\Controller\AbstractActionController;

class ConsoleController extends AbstractActionController
{
    /**
     * @var Client
     */
    protected $client;

    /**
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function purgeAction()
    {
        $domain = $this->params('domain');

        $this->client->purge($domain);

        return sprintf(
            "\nCache purged for domain %s\n\n",
            $domain
        );
    }
}