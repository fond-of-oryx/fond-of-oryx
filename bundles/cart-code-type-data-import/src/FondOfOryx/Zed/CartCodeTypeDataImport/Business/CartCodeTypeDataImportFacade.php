<?php

namespace FondOfOryx\Zed\CartCodeTypeDataImport\Business;

use Generated\Shared\Transfer\DataImporterConfigurationTransfer;
use Generated\Shared\Transfer\DataImporterReportTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\CartCodeTypeDataImport\Business\CartCodeTypeDataImportBusinessFactory getFactory()
 */
class CartCodeTypeDataImportFacade extends AbstractFacade implements CartCodeTypeDataImportFacadeInterface
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
        return $this->getFactory()
            ->createCartCodeTypeDataImporter()
            ->import($dataImporterConfigurationTransfer);
    }
}
