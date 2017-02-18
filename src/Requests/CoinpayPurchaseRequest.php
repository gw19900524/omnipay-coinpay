<?php

namespace Omnipay\Coinpay\Requests;

use Omnipay\Coinpay\Responses\LegacyExpressPurchaseResponse;
use Omnipay\Common\Message\AbstractRequest;
use Omnipay\Common\Message\ResponseInterface;
use Omnipay\Common\Message\ResponseInterface;

/**
 * Class LegacyExpressPurchaseRequest
 * @package Omnipay\Coinpay\Requests
 */
class CoinpayPurchaseRequest extends AbstractLegacyRequest
{


    public function getData()
    {
        $this->validateParams();
        $data = $this->filter($this->parameters->all());
        return $data;
    }

    protected function validateParams()
    {
        $this->validate(
            '_input_charset',
            'out_trade_no',
            'subject',
            'payment_type',
            'total_fee'
        );

        $this->validateOne(
            'seller_id',
            'seller_email',
            'seller_account_name'
        );
    }

    public function sendData($data)
    {
        return $this->response = new LegacyExpressPurchaseResponse($this, $data);
    }

    public function getOutTradeNo()
    {
        return $this->getParameter('out_trade_no');
    }

    public function setOutTradeNo($value)
    {
        return $this->setParameter('out_trade_no', $value);
    }
}
