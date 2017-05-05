<?php

namespace Omnipay\Instamojo\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RequestInterface;
use Omnipay\Common\Message\RedirectResponseInterface;

/**
 * Instamojo Response
 */
class Response extends AbstractResponse implements RedirectResponseInterface
{

    public function isSuccessful()
    {
        return !empty($this->data['success']);
    }

    public function isRedirect()
    {
        return !empty($this->data['payment_request']['longurl']);
    }

    public function getRedirectUrl()
    {
        return $this->redirectUrl = $this->isRedirect() ? $this->data['payment_request']['longurl'] : null;
    }

    /**
     * Gateway Reference
     *
     * @return null|string A reference provided by the gateway to represent this transaction
     */
    public function getTransactionReference()
    {
        return !empty($this->data['payment_request']['id']) ? $this->data['payment_request']['id'] : null;
    }

    /**
     * Response Message
     *
     * @return null|string A response message from the payment gateway
     */
    public function getMessage()
    {
        return json_encode($this->data['message']);
    }

    public function getRedirectMethod()
    {
        return 'GET';
    }

    public function getRedirectData()
    {
        return $this->getData();
    }
}
