<?php

namespace FondOfOryx\Zed\AvailabilityAlertDataImport\Communication\Plugin;

use FondOfOryx\Zed\AvailabilityAlertDataImport\AvailabilityAlertDataImportConfig;
use Generated\Shared\Transfer\DataImporterConfigurationTransfer;
use Spryker\Zed\DataImport\Dependency\Plugin\DataImportPluginInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfOryx\Zed\AvailabilityAlertDataImport\Business\AvailabilityAlertDataImportFacadeInterface getFacade()
 * @method \FondOfOryx\Zed\AvailabilityAlertDataImport\AvailabilityAlertDataImportConfig getConfig()
 */
class AvailabilityAlertDataImportPlugin extends AbstractPlugin implements DataImportPluginInterface
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
        return AvailabilityAlertDataImportConfig::IMPORT_TYPE_AVAILABILITY_ALERT;
    }
}
