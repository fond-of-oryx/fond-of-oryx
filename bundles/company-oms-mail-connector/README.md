# Company OMS Mail Connector
[![CI](https://github.com/fond-of-oryx/company-oms-mail-connector/actions/workflows/main.yml/badge.svg)](https://github.com/fond-of-oryx/company-oms-mail-connector/actions/workflows/main.yml)
[![license](https://img.shields.io/github/license/fond-of-oryx/company-oms-mail-connector.svg)](https://packagist.org/packages/fond-of-oryx/company-oms-mail-connector)

Provides plugins to register in OmsDependencyProvider. In our case the customer service can create orders for our b2b customer. When the cs create those orders, the order confirmation email will be send to the customer service instead of the customer.

#### CompanyLocaleOmsOrderMailExpanderPlugin

This plugin will add the email address from the company business unit as recipient.

#### CompanyEmailOmsOrderMailExpanderPlugin

This plugin will correct the locale for the mail. For example the customer service creates the order with german locale settings and the customer is from italy. The customer will normally receive the order confirmation in german. This plugin overrides the locale with the company locale and uses default as fallback.

## Installation

```
composer require fond-of-oryx/company-oms-mail-connector
```

## Configuration

Register oms order mail plugins in `src/Pyz/Zed/Oms/OmsDependencyProvider.php`

```/**
* @param \Spryker\Zed\Kernel\Container $container
*
* @return \Spryker\Zed\OmsExtension\Dependency\Plugin\OmsOrderMailExpanderPluginInterface[]
*/
protected function getOmsOrderMailExpanderPlugins(Container $container): array
{
    return [
        ...
        new CompanyLocaleOmsOrderMailExpanderPlugin(),
        new CompanyEmailOmsOrderMailExpanderPlugin(),
    ];
}```
