# Payment EPC-QR-Code

[![license](https://img.shields.io/github/license/fond-of-oryx/payment-epc-qr-code.svg)](https://packagist.org/packages/fond-of-oryx/payment-epc-qr-code)

## Description
Generates an valid EPC QR-Code for prepayment orders and provide the qr code data in oms mail template so customer can scan the qr code to fill in transfer data

## Installation

```
composer require fond-of-oryx/payment-epc-qr-code
```

Register plugin PaymentEpcQrCodeExpanderPlugin in src/Pyz/Zed/Oms/OmsDependencyProvider.php

```
    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\OmsExtension\Dependency\Plugin\OmsOrderMailExpanderPluginInterface[]
     */
    protected function getOmsOrderMailExpanderPlugins(Container $container)
    {
        return [
            ...
            new PaymentEpcQrCodeExpanderPlugin(),
        ];
    }
```

## Usage
Add in 'order_confirmation.html.twig' something like

```
{% if mail.order.prepaymentEpcQrData is defined and mail.order.prepaymentEpcQrData != null %}
    <img width="250" class="epc-qr-code" src="{{ mail.order.prepaymentEpcQrData }}"/>
{% endif %}
```
