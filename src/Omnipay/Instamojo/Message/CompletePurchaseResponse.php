<?php

namespace Omnipay\Instamojo\Message;

/**
 * Class CompletePurchaseResponse
 * @package Omnipay\Instamojo\Message
 */
class CompletePurchaseResponse extends Response
{
    /**
     * @return null
     */
    public function getCode()
    {
        return (
            isset($this->data['ErrorCode']) &&
            $this->data['ErrorCode'] != ''
        ) ? $this->data['ErrorCode'] : null;
    }

    /**
     * @return mixed
     */
    public function getTransactionReference()
    {
        if (isset($this->data['payment']['payment_id'])) {
            return $this->data['payment']['payment_id'];
        }

        return null;
    }

    /**
     * @return mixed
     */
    public function getCurrency()
    {
        if (isset($this->data['payment']['currency'])) {
            return $this->data['payment']['currency'];
        }

        return null;
    }

    /**
     * @return mixed
     */
    public function getAmount()
    {
        if (isset($this->data['payment']['amount'])) {
            return $this->data['payment']['amount'];
        }

        return null;
    }

    /**
     * @return mixed
     */
    public function getBankFees()
    {
        if (isset($this->data['payment']['fees'])) {
            return $this->data['payment']['fees'];
        }

        return null;
    }

}
