<?php

namespace Omnipay\Instamojo\Message;

/**
 * Instamojo Abstract Request
 */
abstract class AbstractRequest extends \Omnipay\Common\Message\AbstractRequest
{
    protected $liveEndpoint = 'https://www.instamojo.com/api/1.1/';
    protected $testEndpoint = 'https://test.instamojo.com/api/1.1/';

    public function getSalt()
    {
        return $this->getParameter('salt');
    }

    public function setSalt($value)
    {
        return $this->setParameter('salt', $value);
    }

    /**
     * function to send the instamojo link
     * @return [type] [description]
     */
    public function getLink()
    {
        return $this->getParameter('link');
    }

    public function setLink($value)
    {
        return $this->setParameter('link', $value);
    }

    public function getApiKey()
    {
        return $this->getParameter('api_key');
    }

    public function setApiKey($value)
    {
        return $this->setParameter('api_key', $value);
    }

    public function getAuthToken()
    {
        return $this->getParameter('auth_token');
    }

    public function setAuthToken($value)
    {
        return $this->setParameter('auth_token', $value);
    }

    public function sendData($data)
    {
        return $this->response = new Response($this, $data);
    }

    protected function getEndpoint()
    {
        return $this->getTestMode() ? $this->testEndpoint : $this->liveEndpoint;
    }

    public function getData()
    {
        return [];
    }
}
