<?php
namespace CloudFlare\Service;

use CloudFlare\Exception;

class SettingsService extends AbstractService
{
    const CACHE_LEVEL_AGGRESSIVE = 'agg';
    const CACHE_LEVEL_BASIC = 'basic';

    const SECURITY_LEVEL_HELP = 'help';
    const SECURITY_LEVEL_HIGH = 'high';
    const SECURITY_LEVEL_MEDIUM = 'med';
    const SECURITY_LEVEL_LOW = 'low';
    const SECURITY_LEVEL_ESSENTIALLY_OFF = 'eoff';

    const DEVELOPMENT_MODE_ON = 1;
    const DEVELOPMENT_MODE_OFF = 0;

    const MINIFY_OFF = 0;
    const MINIFY_JAVASCRIPT_ONLY = 1;
    const MINIFY_CSS_ONLY = 2;
    const MINIFY_JAVASCRIPT_AND_CSS = 3;
    const MINIFY_HTML_ONLY = 4;
    const MINIFY_JAVASCRIPT_AND_HTML = 5;
    const MINIFY_CSS_AND_HTML = 6;
    const MINIFY_CSS_JAVASCRIPT_AND_HTML = 7;

    /**
     * @var array
     */
    protected $cacheLevels = array(
        self::CACHE_LEVEL_AGGRESSIVE => 'Aggressive',
        self::CACHE_LEVEL_BASIC      => 'Basic',
    );

    /**
     * @var array
     */
    protected $securityLevels = array(
        self::SECURITY_LEVEL_HELP            => 'Help',
        self::SECURITY_LEVEL_HIGH            => 'High',
        self::SECURITY_LEVEL_MEDIUM          => 'Medium',
        self::SECURITY_LEVEL_LOW             => 'Low',
        self::SECURITY_LEVEL_ESSENTIALLY_OFF => 'Essentialy off',
    );

    /**
     * @var array
     */
    protected $minificationValues = array(
        self::MINIFY_OFF                     => 'Off',
        self::MINIFY_JAVASCRIPT_ONLY         => 'Javascript only',
        self::MINIFY_CSS_ONLY                => 'CSS only',
        self::MINIFY_JAVASCRIPT_AND_CSS      => 'Javascript and CSS',
        self::MINIFY_HTML_ONLY               => 'HTML only',
        self::MINIFY_JAVASCRIPT_AND_HTML     => 'Javascript and HTML',
        self::MINIFY_CSS_AND_HTML            => 'CSS and HTML',
        self::MINIFY_CSS_JAVASCRIPT_AND_HTML => 'CSS, Javascript and HTML',
    );

    /**
     * List all current setting values
     *
     * Retrieves all current settings for a given domain.
     *
     * @param  string $domain
     * @return array
     */
    public function getSettings($domain)
    {
        $data = array(
            'a' => 'zone_settings',
            'z' => $domain,
        );

        $response = $this->send($data);

        return $response->result->objs[0];
    }

    /**
     * Clear CloudFlare's Cache
     *
     * This function will purge CloudFlare of any cached files.
     * It may take up to 48 hours for the cache to rebuild and optimum performance to be achieved.
     * This function should be used sparingly.
     *
     * @param  string $domain
     * @return void
     */
    public function purge($domain)
    {
        $data = array(
            'a' => 'fpurge_ts',
            'z' => $domain,
            'v' => 1,
        );

        $this->send($data);
    }

    /**
     * Get the cache level
     *
     * @param  string $domain
     * @return string
     */
    public function getCacheLevel($domain)
    {
        $settings = $this->getSettings($domain);
        if (!isset($settings->cache_lvl)
            || !array_key_exists($settings->cache_lvl, $this->cacheLevels)
        ) {
            return null;
        }

        return $this->cacheLevels[$settings->cache_lvl];
    }

    /**
     * Set the cache level
     *
     * This function sets the Caching Level to Aggressive or Basic.
     *
     * @param  string $domain
     * @param  string $level
     * @return void
     */
    public function setCacheLevel($domain, $level)
    {
        if (!array_key_exists($level, $this->cacheLevels)) {
            throw new Exception\InvalidArgumentException(
                'The cache level specified is not valid'
            );
        }

        $data = array(
            'a' => 'cache_lvl',
            'z' => $domain,
            'v' => $level,
        );

        $this->send($data);
    }

    /**
     * Get the security level
     *
     * @param  string $domain
     * @return string
     */
    public function getSecurityLevel($domain)
    {
        $settings = $this->getSettings($domain);
        if (!isset($settings->sec_lvl)
            || !array_key_exists($settings->sec_lvl, $this->securityLevels)
        ) {
            return null;
        }

        return $this->securityLevels[$settings->sec_lvl];
    }

    /**
     * Set the security level
     *
     * This function sets the Basic Security Level to I'M UNDER ATTACK! / HIGH / MEDIUM / LOW / ESSENTIALLY OFF.
     *
     * @param  string $domain
     * @param  string $level
     * @return void
     */
    public function setSecurityLevel($domain, $level)
    {
        if (!array_key_exists($level, $this->securityLevels)) {
            throw new Exception\InvalidArgumentException(
                'The security level specified is not valid'
            );
        }

        $data = array(
            'a' => 'sec_lvl',
            'z' => $domain,
            'v' => $level,
        );

        $this->send($data);
    }

    /**
     * Get the development mode status
     *
     * @param  string $domain
     * @return string
     */
    public function getDevelopmentMode($domain)
    {
        $settings = $this->getSettings($domain);
        if (!$settings->dev_mode) {
            return 'Off';
        }

        return 'On';
    }

    /**
     * Toggling Development Mode
     *
     * This function allows you to toggle Development Mode on or off for a particular domain.
     * When Development Mode is on the cache is bypassed.
     * Development mode remains on for 3 hours or until when it is toggled back off.
     *
     * @param  string $domain
     * @param  int $mode
     * @return void
     */
    public function setDevelopmentMode($domain, $mode)
    {
        if ($mode != self::DEVELOPMENT_MODE_ON && $mode != self::DEVELOPMENT_MODE_OFF) {
            throw new Exception\InvalidArgumentException(
                'The development mode specified is not valid'
            );
        }

        $data = array(
            'a' => 'devmode',
            'z' => $domain,
            'v' => $mode,
        );

        $this->send($data);
    }

    /**
     * Get the minification
     *
     * @param  string $domain
     * @return string
     */
    public function getMinification($domain)
    {
        $settings = $this->getSettings($domain);
        if (!isset($settings->minify)
            || !array_key_exists($settings->minify, $this->minificationValues)
        ) {
            return null;
        }

        return $this->minificationValues[$settings->minify];
    }

    /**
     * Set the minification
     *
     * Changes minification settings.
     *
     * @param  string $domain
     * @param  string $value
     * @return void
     */
    public function setMinification($domain, $value)
    {
        if (!array_key_exists($value, $this->minificationValues)) {
            throw new Exception\InvalidArgumentException(
                'The minification value specified is not valid'
            );
        }

        $data = array(
            'a' => 'minify',
            'z' => $domain,
            'v' => $value,
        );

        $this->send($data);
    }
}