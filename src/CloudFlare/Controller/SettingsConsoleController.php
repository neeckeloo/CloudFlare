<?php
namespace CloudFlare\Controller;

use CloudFlare\Service\SettingsService;
use CloudFlare\Exception;
use Zend\Mvc\Controller\AbstractActionController;

class SettingsConsoleController extends AbstractActionController
{
    /**
     * @var SettingsService
     */
    protected $settingsService;

    /**
     * @param SettingsService $settingsService
     */
    public function __construct(SettingsService $settingsService)
    {
        $this->settingsService = $settingsService;
    }

    public function purgeAction()
    {
        $domain = $this->params('domain');

        try {
            $this->settingsService->purge($domain);
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
            $this->settingsService->setCacheLevel($domain, $level);
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
            $this->settingsService->setSecurityLevel($domain, $level);
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
            $this->settingsService->setDevelopmentMode($domain, $mode);
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