<?php

namespace FondOfOryx\Zed\ShipmentTableRateDataImport\Communication\Plugin\DataImport;

use FondOfOryx\Zed\ShipmentTableRateDataImport\ShipmentTableRateDataImportConfig;
use Generated\Shared\Transfer\DataImporterConfigurationTransfer;
use Spryker\Zed\DataImport\Dependency\Plugin\DataImportPluginInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfOryx\Zed\ShipmentTableRateDataImport\Business\ShipmentTableRateDataImportFacadeInterface getFacade()
 * @method \FondOfOryx\Zed\ShipmentTableRateDataImport\ShipmentTableRateDataImportConfig getConfig()
 */
class ShipmentTableRateDataImportPlugin extends AbstractPlugin implements DataImportPluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\DataImporterConfigurationTransfer|null $dataImporterConfigurationTransfer
     *
     * @return \Generated\Shared\Transfer\DataImporterReportTransfer
     */
    public function import(?DataImporterConfigurationTransfer $dataImporterConfigurationTransfer = null)
    {
        return $this->getFacade()->import($dataImporterConfigurationTransfer);
    }

    /**
     * @return string
     */
    public function getImportType()
    {
        return ShipmentTableRateDataImportConfig::IMPORT_TYPE_SHIPMENT_TABLE_RATE;
    }
}
