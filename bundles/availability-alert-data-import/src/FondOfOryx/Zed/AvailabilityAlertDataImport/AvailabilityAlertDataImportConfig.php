<?php

namespace FondOfOryx\Zed\AvailabilityAlertDataImport;

use Spryker\Zed\DataImport\DataImportConfig;

class AvailabilityAlertDataImportConfig extends DataImportConfig
{
    public const IMPORT_TYPE_AVAILABILITY_ALERT = 'availability-alert';

    /**
     * @return \Generated\Shared\Transfer\DataImporterConfigurationTransfer
     */
    public function getAvailabilityAlertDataImporterConfiguration()
    {
        return $this->buildImporterConfiguration('availability_alert.csv', static::IMPORT_TYPE_AVAILABILITY_ALERT);
    }
}
