<?php
namespace CloudFlare;

use Zend\Stdlib\AbstractOptions;

class ModuleOptions extends AbstractOptions implements ModuleOptionsInterface
{
    /**
     * @var string
     */
    protected $apiUrl = 'https://www.cloudflare.com/api_json.html';

    /**
     * @var string
     */
    protected $email = null;
    
    /**
     * @var string
     */
    protected $token = null;

    /**
     * {@inheritdoc}
     */
    public function setApiUrl($url)
    {
        $this->apiUrl = (string) $url;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getApiUrl()
    {
        return $this->apiUrl;
    }

    /**
     * {@inheritdoc}
     */
    public function setEmail($email)
    {
        $this->email = (string) $email;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * {@inheritdoc}
     */
    public function setToken($token)
    {
        $this->token = (string) $token;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getToken()
    {
        return $this->token;
    }
}