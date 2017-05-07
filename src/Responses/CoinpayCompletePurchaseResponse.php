<?php

namespace Omnipay\Coinpay\Responses;

use Omnipay\Coinpay\Requests\CoinpayCompletePurchaseRequest;
use Omnipay\Common\Message\AbstractResponse;

class CoinpayCompletePurchaseResponse extends AbstractResponse
{

    /**
     * @var CoinpayCompletePurchaseRequest
     */
    protected $request;

    public function getResponseText()
    {
        if ($this->isSuccessful()) {
            return 'success';
        } else {
            return 'fail';
        }
    }

    public function isSuccessful()
    {
        if ($this->request->getSign() == $this->data['sign']) {
            return true;
        }
        return false;
    }

    public function isPaid()
    {
        if (array_get($this->data, 'status')) {
            if (array_get($this->data, 'status') == 1) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}
