<?php

namespace FondOfOryx\Zed\AvailabilityAlertDataImport\Business;

use Generated\Shared\Transfer\DataImporterConfigurationTransfer;
use Generated\Shared\Transfer\DataImporterReportTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @api
 *
 * @method \FondOfOryx\Zed\AvailabilityAlertDataImport\Business\AvailabilityAlertDataImportBusinessFactory getFactory()
 */
class AvailabilityAlertDataImportFacade extends AbstractFacade implements AvailabilityAlertDataImportFacadeInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\DataImporterConfigurationTransfer|null $dataImporterConfigurationTransfer
     *
     * @return \Generated\Shared\Transfer\DataImporterReportTransfer
     */
    public function import(?DataImporterConfigurationTransfer $dataImporterConfigurationTransfer = null): DataImporterReportTransfer
    {
        return $this->getFactory()->createAvailabilityAlertImporter()->import($dataImporterConfigurationTransfer);
    }
}
