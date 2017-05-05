<?php

namespace Omnipay\Instamojo\Message;

use Guzzle\Http\Exception\ClientErrorResponseException;

/**
 * Instamojo Purchase Request
 */
class PurchaseRequest extends AbstractRequest
{
    public function getData()
    {
        $data = parent::getData();

        $this->validate('amount');
        $this->validate('purpose');

        $data['amount'] = $this->getAmount();
        $data['purpose'] = $this->getPurpose();
        $data['buyer_name'] = $this->getBuyerName();
        $data['email'] = $this->getEmail();
        $data['phone'] = $this->getPhone();
        $data['redirect_url'] = $this->getRedirectUrl();
        $data['webhook'] = $this->getWebhook();
        $data['allow_repeated_payments'] = $this->getAllowRepeatedPayments();
        $data['send_email'] = $this->getSendEmail();
        $data['send_sms'] = $this->getSendSms();
        $data['expires_at'] = $this->getExpiresAt();

        return $data;
    }

    public function sendData($data)
    {
        $httpRequest = $this->httpClient->post($this->getEndpoint() . 'payment-requests/', null, $data);
        $httpRequest
            ->setHeader('X-Api-key', $this->getApiKey())
            ->setHeader('X-Auth-Token', $this->getAuthToken());

        try {
            $httpResponse = $httpRequest->send();
        } catch (ClientErrorResponseException $e) {
            $httpResponse = $e->getResponse();
        }

        return $this->response = new Response($this, $httpResponse->json());
    }

    public function getPurpose()
    {
        return $this->getParameter('purpose');
    }

    public function setPurpose($value)
    {
        return $this->setParameter('purpose', $value);
    }

    public function getBuyerName()
    {
        return $this->getParameter('buyer_name');
    }

    public function setBuyerName($value)
    {
        return $this->setParameter('buyer_name', $value);
    }

    public function getEmail()
    {
        return $this->getParameter('email');
    }

    public function setEmail($value)
    {
        return $this->setParameter('email', $value);
    }

    public function getPhone()
    {
        return $this->getParameter('phone');
    }

    public function setPhone($value)
    {
        return $this->setParameter('phone', $value);
    }

    public function getRedirectUrl()
    {
        return $this->getParameter('redirect_url');
    }

    public function setRedirectUrl($value)
    {
        return $this->setParameter('redirect_url', $value);
    }

    public function getWebhook()
    {
        return $this->getParameter('webhook');
    }

    public function setWebhook($value)
    {
        return $this->setParameter('webhook', $value);
    }

    public function getAllowRepeatedPayments()
    {
        return (bool)$this->getParameter('allow_repeated_payments');
    }

    public function setAllowRepeatedPayments($value)
    {
        return $this->setParameter('allow_repeated_payments', (bool)$value);
    }

    public function getSendEmail()
    {
        return (bool)$this->getParameter('send_email');
    }

    public function setSendEmail($value)
    {
        return $this->setParameter('send_email', (bool)$value);
    }

    public function getSendSms()
    {
        return (bool)$this->getParameter('send_sms');
    }

    public function setSendSms($value)
    {
        return $this->setParameter('send_sms', (bool)$value);
    }

    public function getExpiresAt()
    {
        return $this->getParameter('expires_at');
    }

    public function setExpiresAt($value)
    {
        return $this->setParameter('expires_at', $value);
    }

}
