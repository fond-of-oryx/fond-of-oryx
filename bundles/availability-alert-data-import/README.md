# Data Import for Availability Alerts
[![Build Status](https://travis-ci.org/fond-of/spryker-availability-alert-data-import.svg?branch=master)](https://travis-ci.org/fond-of/spryker-availability-alert-data-import)
[![PHP from Travis config](https://img.shields.io/travis/php-v/symfony/symfony.svg)](https://php.net/)
[![license](https://img.shields.io/github/license/mashape/apistatus.svg)](https://packagist.org/packages/fond-of-oryx/availability-alert-data-import)


This extension makes it possible import the availability alerts

## Installation

```
composer require fond-of-oryx/availability-alert-data-import
```

## 1. Add Data Importer Plugin in  Pyz\Zed\DataImport\DataImportDependencyProvider

```
 /**
     * @return array
     */
    protected function getDataImporterPlugins(): array
    {
        return [
            [new AvailabilityAlertDataImportPlugin(), DataImportConfig::IMPORT_TYPE_AVAILABILITY_ALERT]
            ........
        ];
    }

```

## 2. Add Import type constant in  Pyz\Zed\DataImport\DataImportConfig

```
 const IMPORT_TYPE_AVAILABILIY_ALERT = 'availability-alert';

```

## 3. Create data import file

```
 availability_alert.csv

```

