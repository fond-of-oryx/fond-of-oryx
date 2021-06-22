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

## Configuration
As default the config params from fond-of-oryx/qr-code-generator would be used. But you can override them with the following constants in you config.

| Const                                               | Default         | Note                                       |
|:----------------------------------------------------|:----------------|:-------------------------------------------|
| EPC_QR_CODE_QR_CODE_FORMAT                          | png             | format (png, svg, binary, eps, pdf, debug) |
| EPC_QR_CODE_QR_CODE_ENCODING_OVERRIDE               | UTF-8           | encoding                                   |
| EPC_QR_CODE_QR_CODE_ERROR_CORRECTION_LEVEL_OVERRIDE | 1               | low 0, medium 1, high 2, quartile 3        |
| EPC_QR_CODE_QR_CODE_SIZE_OVERRIDE                   | 250             | size in pixel                              |
| EPC_QR_CODE_QR_CODE_MARGIN_OVERRIDE                 | 5               | space from border                          |
| EPC_QR_CODE_QR_CODE_FOREGROUND_COLOR_OVERRIDE       | [0, 0, 0]       | [red, green, blue] black                   |
| EPC_QR_CODE_QR_CODE_ROUNDED_BLOCK_SIZE_MODE_OVERRIDE| 1               | none 0, margin 1, enlarge 2, shrink 3      |
| EPC_QR_CODE_QR_CODE_BACKGROUND_COLOR_OVERRIDE       | [255, 255, 255] | [red, green, blue] white                   |

### Unique config params from this package
See the overview of EPC QR Code format [here - to wikipedia](https://de.wikipedia.org/wiki/EPC-QR-Code)

| Line | Example                | CONST                        | Note                              |
|:-----|:-----------------------|:-----------------------------|-----------------------------------|
| 1    | BCD                    | EPC_QR_CODE_DATA_SERVICE_TAG | normally fixed!                   |
| 2    | 002                    | EPC_QR_CODE_DATA_VERSION     | 001 or 002                        |
| 3    | 2                      | EPC_QR_CODE_DATA_ENCODING    | 1=UTF-8, 2=ISO 8859-1, 3=ISO 8859-2, 4=ISO 8859-4, 5=ISO 8859-5, 6=ISO 8859-7, 7=ISO 8859-10, 8=ISO 8859-15|
| 4    | SCT                    | EPC_QR_CODE_DATA_TYPE        | SEPA Credit Transfer              |
| 5    | BIC                    |                              | variable value come from transfer |
| 6    | Payment Receiver       |                              | variable value come from transfer |
| 7    | IBAN                   |                              | variable value come from transfer |
| 8    | ISO_CURRENCY_AND_VALUE |                              | variable value come from transfer |
| 9    | CHAR                   | EPC_QR_CODE_DATA_PURPOSE     | 4 chars, optional                 |
| 10   | 4_CHAR_REF_CODE        |                              | variable value come from transfer |
| 11   | USAGE                  |                              | variable value come from transfer |
| 12   | NOTE                   |                              | max. 70 chars, optional           |

IBAN, BIC, Payment Receiver has to be set in config.
