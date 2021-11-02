<?php

namespace FondOfOryx\Zed\ShipmentTableRateDataImport;

use Generated\Shared\Transfer\DataImporterConfigurationTransfer;
use Spryker\Zed\DataImport\DataImportConfig;

class ShipmentTableRateDataImportConfig extends DataImportConfig
{
    /**
     * @var string
     */
    public const IMPORT_TYPE_SHIPMENT_TABLE_RATE = 'shipment-table-rate';

    /**
     * @return \Generated\Shared\Transfer\DataImporterConfigurationTransfer
     */
    public function getShipmentTableRateDataImporterConfiguration(): DataImporterConfigurationTransfer
    {
        return $this->buildImporterConfiguration(
            'shipment_table_rate.csv',
            static::IMPORT_TYPE_SHIPMENT_TABLE_RATE,
        );
    }
}
