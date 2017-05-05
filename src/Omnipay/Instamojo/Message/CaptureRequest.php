<?php

namespace Omnipay\Instamojo\Message;

use Omnipay\Common\Exception\InvalidRequestException;

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
        $data = $this->getParameters();
        $mac_provided = $data['mac'];  // Get the MAC from the POST data
        unset($data['mac']);  // Remove the MAC key from the data.
        ksort($data, SORT_STRING | SORT_FLAG_CASE);

        $mac_calculated = hash_hmac('sha1', implode('|', $data), $this->getSalt());
        if ($mac_provided == $mac_calculated) {
            return $data;
        } else {
            throw new InvalidRequestException('MAC mismatch');
        }
    }

    /**
     * @param mixed $data
     * @return CompletePurchaseResponse
     */
    public function sendData($data)
    {
        return $this->response = new CompletePurchaseResponse($this, $data);
    }

}
