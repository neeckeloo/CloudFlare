<?php
namespace CloudFlare;

interface ModuleOptionsInterface
{
    /**
     * @param  string $url
     * @return self
     */
    public function setApiUrl($url);

    /**
     * @return string
     */
    public function getApiUrl();

    /**
     * @param  string $email
     * @return self
     */
    public function setEmail($email);

    /**
     * @return string
     */
    public function getEmail();

    /**
     * @param  string $token
     * @return self
     */
    public function setToken($token);

    /**
     * @return string
     */
    public function getToken();
}