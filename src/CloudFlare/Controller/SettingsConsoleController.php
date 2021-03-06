<?php
namespace CloudFlare\Controller;

use CloudFlare\Service\SettingsService;
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

        $this->settingsService->purge($domain);

        return sprintf(
            "\nCache purged for domain %s\n\n",
            $domain
        );
    }

    public function cacheLevelAction()
    {
        $domain = $this->params('domain');
        $level = $this->params('level');

        if (null === $level) {
            return sprintf(
                "\nCache level for \"%s\" domain: %s\n\n",
                $domain,
                $this->settingsService->getCacheLevel($domain)
            );
        }

        $this->settingsService->setCacheLevel($domain, $level);

        return sprintf(
            "\nCache level for domain %s changed\n\n",
            $domain
        );
    }

    public function securityLevelAction()
    {
        $domain = $this->params('domain');
        $level = $this->params('level');

        if (null === $level) {
            return sprintf(
                "\nSecurity level for \"%s\" domain: %s\n\n",
                $domain,
                $this->settingsService->getSecurityLevel($domain)
            );
        }

        $this->settingsService->setSecurityLevel($domain, $level);

        return sprintf(
            "\nSecurity level for domain %s changed\n\n",
            $domain
        );
    }

    public function developmentModeAction()
    {
        $domain = $this->params('domain');
        $mode = $this->params('mode');

        if (null === $mode) {
            return sprintf(
                "\nDevelopment mode for \"%s\" domain: %s\n\n",
                $domain,
                $this->settingsService->getDevelopmentMode($domain)
            );
        }

        if ($mode == 'on') {
            $mode = 1;
        } elseif ($mode == 'off') {
            $mode = 0;
        }

        $this->settingsService->setDevelopmentMode($domain, $mode);

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

    public function minificationAction()
    {
        $domain = $this->params('domain');
        $value = $this->params('value');

        if (null === $value) {
            return sprintf(
                "\nMinification for \"%s\" domain: %s\n\n",
                $domain,
                $this->settingsService->getMinification($domain)
            );
        }

        $this->settingsService->setMinification($domain, $value);

        return sprintf(
            "\nMinification for domain %s changed\n\n",
            $domain
        );
    }
}