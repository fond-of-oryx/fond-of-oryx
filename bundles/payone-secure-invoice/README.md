# Payone Secure Invoice
[![license](https://img.shields.io/github/license/fond-of-oryx/payone-secure-invoice.svg)](https://packagist.org/packages/fond-of-oryx/payone-secure-invoice)

To use Payone Secure Invoice the provider demands to use a dedicated payment portal for secure invoice, with dedicated credentials.
This package contains a plugin which allows to add them via config.

## Installation

**Disclaimer:** Right now this plugin can only be used in conjunction with our [Spryker Payone Fork](https://github.com/fond-of/payone).
The specific branch is `feature/dedicated-invoice-credentials`.

```
composer require fond-of-oryx/payone-secure-invoice
```

Enable the plugin by adding it to the dependency provider:

```php
Pyz\Zed\Payone\Business\PayoneDependencyProvider::getStandardParameterMapperPlugins() {
    return [
        new SecureInvoiceDedicatedCredentialsPlugin(),
    ];
}
```

## Configuration

The plugin expects to add the following configuration:

```php
$config[PayoneSecureInvoiceConstants::PAYONE_SECURE_INVOICE_CREDENTIALS] = [
    PayoneSecureInvoiceConstants::PAYONE_CREDENTIALS_AID => '13245',
    PayoneSecureInvoiceConstants::PAYONE_CREDENTIALS_PORTAL_ID => '54321',
    PayoneSecureInvoiceConstants::PAYONE_CREDENTIALS_KEY => '123test',
];
```

Replace the credentials with your specific Payone Portal credentials.
