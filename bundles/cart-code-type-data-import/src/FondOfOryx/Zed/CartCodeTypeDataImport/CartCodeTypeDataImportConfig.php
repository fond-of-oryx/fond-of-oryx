<?php

namespace FondOfOryx\Zed\CartCodeTypeDataImport;

use Generated\Shared\Transfer\DataImporterConfigurationTransfer;
use Spryker\Zed\DataImport\DataImportConfig;

class CartCodeTypeDataImportConfig extends DataImportConfig
{
    public const IMPORT_TYPE_CART_CODE_TYPE = 'cart';

    /**
     * @return \Generated\Shared\Transfer\DataImporterConfigurationTransfer
     */
    public function getShipmentTableRateDataImporterConfiguration(): DataImporterConfigurationTransfer
    {
        return $this->buildImporterConfiguration(
            'shipment_table_rate.csv',
            static::IMPORT_TYPE_SHIPMENT_TABLE_RATE
        );
    }
}
