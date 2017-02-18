<?php

namespace Omnipay\Coinpay;

use Omnipay\Coinpay\Requests\CoinpayCompletePurchaseRequest;
use Omnipay\Coinpay\Requests\CoinpayPurchaseRequest;
use Omnipay\Common\AbstractGateway;

class Gateway extends AbstractGateway
{

    public function getDefaultParameters()
    {
        return [
            'inputCharset' => 'UTF-8',
            'signType'     => 'MD5',
            'paymentType'  => '1',
            'alipaySdk'    => 'lokielse/omnipay-alipay',
        ];
    }
    
    public function getName()
    {
        return 'Coinpay Gateway';
    }

    public function purchase(array $parameters = [])
    {
        dd('purchase test');
        return $this->createRequest(CoinpayPurchaseRequest::class, $parameters);
    }

    public function completePurchase(array $parameters = [])
    {
        dd('complete purchase test');
        return $this->createRequest(CoinpayCompletePurchaseRequest::class, $parameters);
    }

    public function refund(array $parameters = [])
    {
    }

    public function completeRefund(array $parameters = [])
    {
    }

    public function query(array $parameters = [])
    {
    }
}
