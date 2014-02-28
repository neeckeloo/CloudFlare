<?php
namespace CloudFlare\Service;

use CloudFlare\ModuleOptions;
use CloudFlare\ModuleOptionsAwareInterface;

abstract class AbstractService implements ModuleOptionsAwareInterface
{
    /**
     * @var ModuleOptions
     */
    protected $options;

    /**
     * @param ModuleOptions $options
     */
    public function setModuleOptions(ModuleOptions $options)
    {
        $this->options = $options;
    }

    /**
     * @param  array $data
     * @return array
     */
    protected function send(array $data = array())
    {
        $ch = curl_init();

        $data['u'] = $this->options->getEmail();
        $data['tkn'] = $this->options->getToken();

        $curlOptions = array(
            CURLOPT_URL        => $this->options->getApiUrl(),
            CURLOPT_POST       => true,
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_CONNECTTIMEOUT => 10,
            CURLOPT_TIMEOUT        => 60,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => false,
        );

        foreach ($curlOptions as $key => $value) {
            curl_setopt($ch, $key, $value);
        }

        $output = curl_exec($ch);
        $error = curl_error($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode != 200) {
            return array('error' => $error);
        }

        $data = json_decode($output);

        if ($data->result != 'success') {
            throw new Exception\RuntimeException($data->msg);
        }

        return $data->response;
    }
}