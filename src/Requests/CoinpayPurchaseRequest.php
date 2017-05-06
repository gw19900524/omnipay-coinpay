<?php

namespace Omnipay\Coinpay\Requests;

use Omnipay\Coinpay\Common\Signer;
use Omnipay\Coinpay\Responses\CoinpayPurchaseResponse;
use Omnipay\Common\Message\AbstractRequest;
use Omnipay\Common\Message\ResponseInterface;
use Omnipay\Common\Exception\InvalidRequestException;

/**
 * Class CoinpayPurchaseRequest
 * @package Omnipay\Coinpay\Requests
 */
class CoinpayPurchaseRequest extends AbstractRequest
{

    public function getData()
    {
        $this->validateParams();
        $data = $this->parameters->all();
        $data['sign_type'] = $this->getSignType();
        $data['sign'] = $this->sign($data, $this->getSignType());
        return $data;
    }

    protected function validateParams()
    {
        $this->validate(
            'order_serial_number',
            'subject',
            'total_fee',
            'return_url',
            'notify_url'
        );
    }

    public function sendData($data)
    {
        return $this->response = new CoinpayPurchaseResponse($this, $data);
    }

    public function getOrderSerialNumber()
    {
        return $this->getParameter('order_serial_number');
    }

    public function setOrderSerialNumber($value)
    {
        return $this->setParameter('order_serial_number', $value);
    }

    public function getSubject()
    {
        return $this->getParameter('subject');
    }

    public function setSubject($value)
    {
        return $this->setParameter('subject', $value);
    }

    public function getTotalFee()
    {
        return $this->getParameter('total_fee');
    }

    public function setTotalFee($value)
    {
        return $this->setParameter('total_fee', $value);
    }

    public function getReturnUrl()
    {
        return $this->getParameter('return_url');
    }

    public function setReturnUrl($value)
    {
        return $this->setParameter('return_url', $value);
    }

    public function getNotifyUrl()
    {
        return $this->getParameter('notify_url');
    }

    public function setNotifyUrl($value)
    {
        return $this->setParameter('notify_url', $value);
    }

    public function getSignType()
    {
        return $this->sign_type;
    }

    public function setSignType($value)
    {
        $this->sign_type = $value;
        return $this;
    }

    public function getKey()
    {
        return $this->key;
    }

    public function setKey($value)
    {
        $this->key = $value;
        return $this;
    }
    
    public function getEndpoint()
    {
        return $this->endpoint;
    }
    
    public function setEndpoint($value)
    {
        $this->endpoint = $value;
        return $this;
    }
    
    private function sign($params, $signType)
    {
        $signer = new Signer($params);
        $signType = strtoupper($signType);
        if ($signType == 'MD5') {
            if (! $this->getKey()) {
                throw new InvalidRequestException('The `key` is required for `MD5` sign_type');
            }
            $sign = $signer->signWithMD5($this->getKey());
        } else {
            throw new InvalidRequestException('The signType is not allowed');
        }
        return $sign;
    }
}
