<?php
namespace CloudFlare\Controller;

use CloudFlare\Client;
use CloudFlare\Exception;
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

        try {
            $this->client->purge($domain);
        } catch (Exception\ExceptionInterface $e) {
            return "\nError: " . $e->getMessage() . "\n\n";
        }

        return sprintf(
            "\nCache purged for domain %s\n\n",
            $domain
        );
    }

    public function cacheLevelAction()
    {
        $domain = $this->params('domain');
        $level = $this->params('level');

        try {
            $this->client->setCacheLevel($domain, $level);
        } catch (Exception\ExceptionInterface $e) {
            return "\nError: " . $e->getMessage() . "\n\n";
        }

        return sprintf(
            "\nCache level for domain %s changed\n\n",
            $domain
        );
    }

    public function securityLevelAction()
    {
        $domain = $this->params('domain');
        $level = $this->params('level');

        try {
            $this->client->setSecurityLevel($domain, $level);
        } catch (Exception\ExceptionInterface $e) {
            return "\nError: " . $e->getMessage() . "\n\n";
        }

        return sprintf(
            "\nSecurity level for domain %s changed\n\n",
            $domain
        );
    }

    public function developmentModeAction()
    {
        $domain = $this->params('domain');
        $mode = $this->params('mode');

        if ($mode == 'on') {
            $mode = 1;
        } elseif ($mode == 'off') {
            $mode = 0;
        }

        try {
            $this->client->setDevelopmentMode($domain, $mode);
        } catch (Exception\ExceptionInterface $e) {
            return "\nError: " . $e->getMessage() . "\n\n";
        }

        if ($mode) {
            $modeStr = 'enabled';
        } else {
            $modeStr = 'disabled';
        }

        return sprintf(
            "\nDevelopment mode for domain %s %s\n\n",
            $domain,
            $modeStr
        );
    }
}