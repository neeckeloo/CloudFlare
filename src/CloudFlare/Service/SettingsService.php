<?php
namespace CloudFlare\Service;

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

    /**
     * @var array
     */
    protected $cacheLevels = array(
        self::CACHE_LEVEL_AGGRESSIVE,
        self::CACHE_LEVEL_BASIC,
    );

    /**
     * @var array
     */
    protected $securityLevels = array(
        self::SECURITY_LEVEL_HELP,
        self::SECURITY_LEVEL_HIGH,
        self::SECURITY_LEVEL_MEDIUM,
        self::SECURITY_LEVEL_LOW,
        self::SECURITY_LEVEL_ESSENTIALLY_OFF,
    );

    /**
     * Clear CloudFlare's Cache
     *
     * This function will purge CloudFlare of any cached files.
     * It may take up to 48 hours for the cache to rebuild and optimum performance to be achieved.
     * This function should be used sparingly.
     *
     * @param  string $domain
     * @return array
     */
    public function purge($domain)
    {
        $data = array(
            'a' => 'fpurge_ts',
            'z' => $domain,
            'v' => 1,
        );

        return $this->send($data);
    }

    /**
     * Set the cache level
     *
     * This function sets the Caching Level to Aggressive or Basic.
     *
     * @param  string $domain
     * @param  string $level
     * @return array
     */
    public function setCacheLevel($domain, $level)
    {
        if (!in_array($level, $this->cacheLevels)) {
            throw new Exception\InvalidArgumentException(
                'The cache level specified is not valid'
            );
        }

        $data = array(
            'a' => 'cache_lvl',
            'z' => $domain,
            'v' => $level,
        );

        return $this->send($data);
    }

    /**
     * Set the security level
     *
     * This function sets the Basic Security Level to I'M UNDER ATTACK! / HIGH / MEDIUM / LOW / ESSENTIALLY OFF.
     *
     * @param  string $domain
     * @param  string $level
     * @return array
     */
    public function setSecurityLevel($domain, $level)
    {
        if (!in_array($level, $this->securityLevels)) {
            throw new Exception\InvalidArgumentException(
                'The security level specified is not valid'
            );
        }

        $data = array(
            'a' => 'sec_lvl',
            'z' => $domain,
            'v' => $level,
        );

        return $this->send($data);
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
     * @return array
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

        return $this->send($data);
    }
}