<?php

namespace FondOfOryx\Zed\ShipmentTableRateDataImport;

use Codeception\Test\Unit;

class ShipmentTableRateDataImportConfigTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ShipmentTableRateDataImport\ShipmentTableRateDataImportConfig
     */
    protected $shipmentTableRateDataImportConfig;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->shipmentTableRateDataImportConfig = new ShipmentTableRateDataImportConfig();
    }

    /**
     * @return void
     */
    public function testGetShipmentTableRateDataImporterConfiguration(): void
    {
        $dataImporterConfigurationTransfer = $this->shipmentTableRateDataImportConfig
            ->getShipmentTableRateDataImporterConfiguration();

        static::assertEquals(
            ShipmentTableRateDataImportConfig::IMPORT_TYPE_SHIPMENT_TABLE_RATE,
            $dataImporterConfigurationTransfer->getImportType()
        );

        static::assertEquals(
            'shipment_table_rate.csv',
            $dataImporterConfigurationTransfer->getReaderConfiguration()->getFileName()
        );
    }
}
