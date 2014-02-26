<?php
namespace CloudFlare;

class Client
{
    /**
     * @var ModuleOptions
     */
    protected $options;

    /**
     * @param ModuleOptions $options
     */
    public function __construct(ModuleOptions $options)
    {
        $this->options = $options;
    }

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
     * @param  array $data
     * @return array
     */
    protected function send(array $data = array())
    {
        $ch = curl_init();

        $options = $this->getOptions();
        $data['u'] = $options->getEmail();
        $data['tkn'] = $options->getToken();

        $options = array(
            CURLOPT_URL        => $options->getApiUrl(),
            CURLOPT_POST       => true,
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_CONNECTTIMEOUT => 10,
            CURLOPT_TIMEOUT        => 60,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => false,
        );

        foreach ($options as $key => $value) {
            curl_setopt($ch, $key, $value);
        }

        $output = curl_exec($ch);
        $error = curl_error($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode != 200) {
            return array('error' => $error);
        }

        return json_decode($output);
    }
}