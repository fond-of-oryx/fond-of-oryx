<?php

namespace FondOfOryx\Zed\CartCodeTypeDataImport\Communication\Plugin\DataImport;

use FondOfOryx\Zed\CartCodeTypeDataImport\CartCodeTypeDataImportConfig;
use Generated\Shared\Transfer\DataImporterConfigurationTransfer;
use Generated\Shared\Transfer\DataImporterReportTransfer;
use Spryker\Zed\DataImport\Dependency\Plugin\DataImportPluginInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfOryx\Zed\CartCodeTypeDataImport\Business\CartCodeTypeDataImportFacade getFacade()
 * @method \FondOfOryx\Zed\CartCodeTypeDataImport\CartCodeTypeDataImportConfig getConfig()
 */
class CartCodeTypeDataImportPlugin extends AbstractPlugin implements DataImportPluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\DataImporterConfigurationTransfer|null $dataImporterConfigurationTransfer
     *
     * @return \Generated\Shared\Transfer\DataImporterReportTransfer
     */
    public function import(?DataImporterConfigurationTransfer $dataImporterConfigurationTransfer = null): DataImporterReportTransfer
    {
        return $this->getFacade()->import($dataImporterConfigurationTransfer);
    }

    /**
     * @return string
     */
    public function getImportType(): string
    {
        return CartCodeTypeDataImportConfig::IMPORT_TYPE_CART_CODE_TYPE;
    }
}
