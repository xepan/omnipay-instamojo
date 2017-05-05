<?php

namespace Omnipay\Instamojo\Message;

/**
 * Class CompletePurchaseRequest
 * @package Omnipay\Instamojo\Message
 */
class CompletePurchaseRequest extends AbstractRequest
{
    /**
     * @return array
     */
    public function getData()
    {
        $data = [
            'payment_id' => $this->getTransactionReference(),
        ];

        return $data;
    }

    /**
     * @return mixed
     */
    public function getTransactionReference()
    {
        return $this->httpRequest->query->get('payment_id');
    }

    /**
     * @param mixed $data
     * @return CompletePurchaseResponse
     */
    public function sendData($data)
    {
        $paymentId = isset($data['payment_id']) ? $data['payment_id'] : null;
        $httpRequest = $this->createRequest('GET', $this->getEndpoint() . 'payments/' . $paymentId, $data);
        $jsonResponse = $this->sendRequest($httpRequest);

        return $this->response = new CompletePurchaseResponse($this, $jsonResponse);
    }
}
