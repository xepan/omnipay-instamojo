<?php

namespace Omnipay\Instamojo\Message;

/**
 * Class CaptureRequest
 * @package Omnipay\Instamojo\Message
 */
class CaptureRequest extends AbstractRequest
{
    /**
     * @return mixed
     * @throws InvalidRequestException
     */
    public function getData()
    {
        $data = $this->getWebhook();
        $mac_provided = $data['mac'];  // Get the MAC from the POST data
        unset($data['mac']);  // Remove the MAC key from the data.
        ksort($data, SORT_STRING | SORT_FLAG_CASE);

        $mac_calculated = hash_hmac('sha1', implode('|', $data), $this->getSalt());
        if ($mac_provided == $mac_calculated) {
            return $data;
        } else {
            return ['message' => 'MAC mismatch'];
        }
    }

    /**
     * @param mixed $data
     * @return CaptureResponse
     */
    public function sendData($data)
    {
        return $this->response = new CaptureResponse($this, $data);
    }

    /**
     * @return string
     */
    public function getWebhook()
    {
        return $this->getParameter('webhook');
    }

    /**
     * @param $value
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setWebhook($value)
    {
        return $this->setParameter('webhook', $value);
    }

}
