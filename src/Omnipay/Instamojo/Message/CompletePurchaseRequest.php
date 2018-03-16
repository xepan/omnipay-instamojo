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
        if($_GET['payment_id'] && $_GET['paid'] && $_GET['pay_now']) $this->setTransactionReference($_GET['payment_id']);
        $this->validate('transactionReference');
        $data['payment_id'] = $this->getTransactionReference();

        return $data;
    }

    /**
     * @param mixed $data
     * @return CompletePurchaseResponse
     */
    public function sendData($data)
    {
        $httpRequest = $this->createRequest('GET', $this->getEndpoint() . 'payments/' . $data['payment_id']);
        $jsonResponse = $this->sendRequest($httpRequest);
        $this->response = new CompletePurchaseResponse($this, $jsonResponse);
        return $this->response;
    }

}
